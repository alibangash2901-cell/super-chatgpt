# SuperChatGPT 🚀

A multi-platform ChatGPT client with support for desktop, web, and CLI interfaces.

## 📦 Features

- 🖥️ Desktop Application (Rust/Electron)
- 🌐 Web Application (TypeScript/React)
- 💻 CLI Tool (Node.js)
- 🐍 Python Backend API
- 🎨 C# Cross-Platform Client
- 🔗 PHP Web Alternative

## 🏗️ Project Structure

```
super-chatgpt/
├── desktop/          # Rust & Electron desktop app
├── web/              # TypeScript/React web application
├── cli/              # Node.js CLI tool
├── backend/          # Python Flask/FastAPI backend
├── csharp/           # C# desktop client
├── php/              # PHP web application
└── shared/           # Shared utilities and types
```

## 🚀 Getting Started

### Prerequisites
- Node.js 16+
- Python 3.8+
- Rust 1.70+
- .NET 6+ (for C#)
- PHP 8+ (optional)

### Quick Start

1. Clone the repository
```bash
git clone https://github.com/alibangash2901-cell/super-chatgpt.git
cd super-chatgpt
```

2. Install dependencies (see respective platform guides below)

3. Set up environment variables
```bash
cp .env.example .env
# Edit .env with your OpenAI API key
```

## 📱 Platform Guides

### Web Application
```bash
cd web
npm install
npm run dev
```

### CLI Tool
```bash
cd cli
npm install
npm run build
node dist/index.js
```

### Python Backend
```bash
cd backend
python -m venv venv
source venv/bin/activate  # or `venv\Scripts\activate` on Windows
pip install -r requirements.txt
python app.py
```

### Desktop (Rust)
```bash
cd desktop
cargo build --release
cargo run
```

### C# Desktop
```bash
cd csharp
dotnet restore
dotnet run
```

## 🔑 API Configuration

Get your OpenAI API key from [OpenAI Platform](https://platform.openai.com/api-keys)

```env
OPENAI_API_KEY=your_api_key_here
OPENAI_MODEL=gpt-4
```

## 📝 Environment Variables

See `.env.example` for all available configuration options.

## 🤝 Contributing

Contributions are welcome! Please read [CONTRIBUTING.md](CONTRIBUTING.md) for details.

## 📄 License

MIT License - see [LICENSE](LICENSE) for details

## 🐛 Issues & Feedback

Report issues on [GitHub Issues](https://github.com/alibangash2901-cell/super-chatgpt/issues)

## 📧 Contact

For questions, reach out via GitHub discussions or issues.
