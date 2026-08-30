from flask import Flask, request, jsonify
from flask_cors import CORS
import openai
import os
from dotenv import load_dotenv

load_dotenv()

app = Flask(__name__)
CORS(app)

openai.api_key = os.getenv('OPENAI_API_KEY')
model = os.getenv('OPENAI_MODEL', 'gpt-4')

conversations = {}

@app.route('/api/chat', methods=['POST'])
def chat():
    data = request.json
    user_id = data.get('user_id', 'default')
    message = data.get('message')
    
    if not message:
        return jsonify({'error': 'Message is required'}), 400
    
    if user_id not in conversations:
        conversations[user_id] = []
    
    conversations[user_id].append({
        'role': 'user',
        'content': message
    })
    
    try:
        response = openai.ChatCompletion.create(
            model=model,
            messages=conversations[user_id]
        )
        
        assistant_message = response.choices[0].message.content
        conversations[user_id].append({
            'role': 'assistant',
            'content': assistant_message
        })
        
        return jsonify({
            'reply': assistant_message,
            'user_id': user_id
        })
    except Exception as e:
        return jsonify({'error': str(e)}), 500

@app.route('/api/history/<user_id>', methods=['GET'])
def get_history(user_id):
    if user_id in conversations:
        return jsonify({'messages': conversations[user_id]})
    return jsonify({'messages': []})

@app.route('/api/health', methods=['GET'])
def health():
    return jsonify({'status': 'ok'})

if __name__ == '__main__':
    app.run(debug=True, port=5000)
