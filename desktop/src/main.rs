// Tauri desktop app main file
use tauri::Manager;

fn main() {
    tauri::Builder::default()
        .invoke_handler(tauri::generate_handler![send_chat_message])
        .run(tauri::generate_context!())
        .expect("error while running tauri application");
}

#[tauri::command]
async fn send_chat_message(message: String) -> Result<String, String> {
    // Implementation for calling OpenAI API
    Ok(format!("Received: {}", message))
}
