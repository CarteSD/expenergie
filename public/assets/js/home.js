function animateValue(id, start, end, duration) {
    const obj = document.getElementById(id);
    const range = end - start;
    const increment = range / (duration / 16);
    let current = start;
    const timer = setInterval(() => {
        current += increment;
        if (current >= end) {
            current = end;
            clearInterval(timer);
        }
        obj.textContent = Math.floor(current).toString();
    }, 16);
}
window.onload = () => {
    animateValue("years", 0, 15, 1500);
    animateValue("satisfaction", 0, 95, 1500);
    animateValue("etudes", 0, 100, 1500);
};