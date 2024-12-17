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
