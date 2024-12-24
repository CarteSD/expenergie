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

function showModalSuppression(id) {
    let background = document.getElementById('modal-background');
    let modal = document.getElementById(`modalSuppression`);
    document.getElementById('idQuestionSuppr').value = id;
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
    let idQuestion = document.getElementById('idQuestionSuppr').value;
    const xhr = new XMLHttpRequest();
    xhr.open("DELETE", `/office/question/delete/${idQuestion}`, true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            location.reload();
        }
    };
}

function showModalEdition(id) {
    let background = document.getElementById('modal-background');
    let modal = document.getElementById(`modalEdition`);
    let title = document.getElementById('titleQuestionEdit');
    let answer = document.getElementById('answerQuestionEdit');
    let link = document.getElementById('linkQuestionEdit');

    document.getElementById('idQuestionEdit').value = id;

    const xhr = new XMLHttpRequest();
    xhr.open("GET", `/office/question/get/${id}`, true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            let question = JSON.parse(xhr.responseText);
            title.value = question.title;
            answer.value = question.answer;
            link.value = question.link;
        }
    };

    modal.classList.remove("hidden");
    background.classList.remove("hidden");
}