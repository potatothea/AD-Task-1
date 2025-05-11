 function setOperation(operation) {
            document.getElementById('operation').value = operation;
            
            // Highlight the selected button
            const buttons = document.querySelectorAll('.operation-btn');
            buttons.forEach(btn => btn.classList.remove('selected'));
            
            event.target.classList.add('selected');
            
            // Show a quick confirmation
            const resultDiv = document.getElementById('result');
            resultDiv.textContent = 'Selected: ' + operation;
            resultDiv.classList.add('highlight', 'fade-in');
            
            setTimeout(() => {
                resultDiv.classList.remove('highlight');
            }, 1000);
        }
        
        // Add keyboard support
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Enter') {
                document.querySelector('form').submit();
            }
        });