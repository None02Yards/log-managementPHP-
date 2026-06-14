export async function loadSnapshot() {

    const target =
        document.getElementById(
            "snapshotContent"
        );

    try {

        const res =
            await fetch(
                "/api/snapshot"
            );

        const data =
            await res.json();

        target.innerHTML = `
            <div>
                Logs:
                <strong>${data.logs}</strong>
            </div>

            <div>
                Sources:
                <strong>${data.sources}</strong>
            </div>

            <div>
                Patterns:
                <strong>${data.patterns}</strong>
            </div>

            <div>
                Reports:
                <strong>${data.reports}</strong>
            </div>
        `;

    } catch {

        target.innerHTML =
            "Snapshot unavailable";
    }
}