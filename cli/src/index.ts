#!/usr/bin/env node

import * as readline from 'readline';
import * as dotenv from 'dotenv';
import OpenAI from 'openai';

dotenv.config();

const client = new OpenAI({
  apiKey: process.env.OPENAI_API_KEY,
});

const rl = readline.createInterface({
  input: process.stdin,
  output: process.stdout,
});

const conversationHistory: Array<{ role: 'user' | 'assistant'; content: string }> = [];

const chat = async (userMessage: string): Promise<string> => {
  conversationHistory.push({
    role: 'user',
    content: userMessage,
  });

  const response = await client.chat.completions.create({
    model: process.env.OPENAI_MODEL || 'gpt-4',
    messages: conversationHistory,
  });

  const assistantMessage = response.choices[0].message.content || '';
  conversationHistory.push({
    role: 'assistant',
    content: assistantMessage,
  });

  return assistantMessage;
};

const main = async () => {
  console.log('🤖 SuperChatGPT CLI - Type "exit" to quit\n');

  const askQuestion = () => {
    rl.question('You: ', async (input) => {
      if (input.toLowerCase() === 'exit') {
        console.log('\nGoodbye!');
        rl.close();
        return;
      }

      if (!input.trim()) {
        askQuestion();
        return;
      }

      try {
        const response = await chat(input);
        console.log(`\nAssistant: ${response}\n`);
      } catch (error) {
        console.error('Error:', error);
      }

      askQuestion();
    });
  };

  askQuestion();
};

main();
