document.querySelectorAll('.faq-question').forEach(question => {
    question.addEventListener('click', function() {
        const answer = this.querySelector('.answer');
        const isExpanded = this.classList.contains('expanded');

        // Ferme toutes les autres questions
        document.querySelectorAll('.faq-question').forEach(otherQuestion => {
            if (otherQuestion !== this && otherQuestion.classList.contains('expanded')) {
                otherQuestion.classList.remove('expanded');
                otherQuestion.querySelector('.answer').style.maxHeight = "0px";
            }
        });

        // Ouvre/ferme la question cliquée
        if (!isExpanded) {
            this.classList.add('expanded');
            answer.style.maxHeight = answer.scrollHeight + "px";
        } else {
            this.classList.remove('expanded');
            answer.style.maxHeight = "0px";
        }
    });
});

function showModal(e) {
    let background = document.getElementById('modal-background');
    let modal = document.getElementById(`modalSuppression`);
    document.getElementById('idQuestion').value = e;
    modal.classList.remove("hidden");
    background.classList.remove("hidden");
}

function closeModal() {
    let background = document.getElementById('modal-background');
    let modals = document.querySelectorAll('.modal');
    modals.forEach(modal => {
        if (!modal.classList.contains('hidden')) {
            modal.classList.add("hidden");
        }
    })
    background.classList.add("hidden");
}

function deleteQuestion(e) {
    let idQuestion = document.getElementById('idQuestion').value;
    const xhr = new XMLHttpRequest();
    xhr.open("DELETE", `/office/question/delete/${idQuestion}`, true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            console.log(xhr.responseText);
            location.reload();
        }
    };
}