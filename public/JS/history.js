export async function loadHistory() {

    const target =
        document.getElementById(
            "historyContent"
        );

    try {

        const res =
            await fetch(
                "/api/history"
            );

        const data =
            await res.json();

        if (!data.length) {

            target.innerHTML =
                "No history available";

            return;
        }

        let html = "";

        data.forEach(run => {

            html += `
                <div class="history-item">

                    <div>
                        <strong>
                            ${run.preset}
                        </strong>
                    </div>

                    <div>
                        ${run.time}
                    </div>

                    <div>
                        Inserted:
                        ${run.inserted}
                    </div>

                </div>
            `;
        });

        target.innerHTML = html;

    } catch {

        target.innerHTML =
            "Failed to load history";
    }
}