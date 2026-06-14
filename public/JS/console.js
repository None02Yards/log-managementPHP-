const logBox =
    document.getElementById("log");

export function log(message) {

    const line =
        document.createElement("div");

    line.className =
        "console-line";

    line.textContent =
        message;

    logBox.appendChild(line);

    logBox.scrollTop =
        logBox.scrollHeight;
}

export function clearConsole() {

    logBox.innerHTML = "";
}