<?php
/*
Plugin Name: ChatGPT Plugin
Description: Plugin para integrar la API de ChatGPT en WordPress.
Version: 1.0
Author: ai dev 
*/

function chatgpt_form_shortcode() {
    ob_start(); ?>
    <div>
        <label for="user_question">Haz tu pregunta:</label>
        <input type="text" id="user_question" name="user_question">
        <button id="submit_question">Enviar</button>
        <div id="chatgpt_response"></div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const submitButton = document.getElementById('submit_question');
            const responseDiv = document.getElementById('chatgpt_response');
            const questionInput = document.getElementById('user_question');

            submitButton.addEventListener('click', function () {
                const userQuestion = questionInput.value;

                // Realiza la solicitud a la API de ChatGPT
                fetch('https://api.openai.com/v1/chat/completions', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': 'Bearer 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',
                    },
                    body: JSON.stringify({
                        model: 'gpt-3.5-turbo',
                        messages: [
                            { role: 'system', content: 'You are a helpful assistant.' },
                            { role: 'user', content: userQuestion },
                        ],
                    }),
                })
                .then(response => response.json())
                .then(data => {
                    // Muestra la respuesta en el div de respuesta
                    responseDiv.innerHTML = 'Respuesta de ChatGPT: ' + data.choices[0].message.content;
                })
                .catch(error => {
                    console.error('Error al realizar la solicitud a la API de ChatGPT:', error);
                    responseDiv.innerHTML = 'Hubo un error al procesar la pregunta.';
                });
            });
        });
    </script>
    <?php
    return ob_get_clean();
}

add_shortcode('chatgpt_form', 'chatgpt_form_shortcode');






