using System.Windows;
using OpenAI_API;

namespace SuperChatGPT
{
    public partial class MainWindow : Window
    {
        private OpenAIAPI api;

        public MainWindow()
        {
            InitializeComponent();
            var apiKey = System.Environment.GetEnvironmentVariable("OPENAI_API_KEY");
            api = new OpenAIAPI(apiKey);
        }

        private async void SendButton_Click(object sender, RoutedEventArgs e)
        {
            string userMessage = InputTextBox.Text;
            if (string.IsNullOrWhiteSpace(userMessage)) return;

            ChatTextBox.AppendText($"You: {userMessage}\n");
            InputTextBox.Clear();

            try
            {
                var result = await api.Chat.CreateChatCompletionAsync(
                    new OpenAI_API.Chat.ChatMessage(OpenAI_API.Chat.ChatMessageRole.User, userMessage)
                );
                
                ChatTextBox.AppendText($"Assistant: {result}\n");
            }
            catch (System.Exception ex)
            {
                ChatTextBox.AppendText($"Error: {ex.Message}\n");
            }
        }
    }
}
