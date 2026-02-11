document.addEventListener("DOMContentLoaded", () => {
    const stakeInput = document.getElementById("stake");
    const oddsInput = document.getElementById("odds");
    const winSpan = document.getElementById("win");

    function updateWin() {
        const stake = parseFloat(stakeInput.value) || 0;
        const odds = parseFloat(oddsInput.value) || 0;
        const win = (stake * odds).toFixed(2);
        winSpan.textContent = win;
    }

    stakeInput.addEventListener("input", updateWin);
    oddsInput.addEventListener("input", updateWin);

    // Aktualizacja przy załadowaniu strony
    updateWin();
});
