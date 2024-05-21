function toggleAccordion(button) {
    const panel = button.nextElementSibling;
    panel.classList.toggle('hidden');
    button.classList.toggle('active');
}
