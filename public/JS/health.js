export async function loadHealth() {

    const target =
        document.getElementById(
            "healthContent"
        );

    try {

        const res =
            await fetch(
                "/api/health"
            );

        const data =
            await res.json();

        target.innerHTML = `
            <div>Database: ${
                data.database
                    ? "✅ Connected"
                    : "❌ Offline"
            }</div>

            <div>Seeder API: ${
                data.seeder_api
                    ? "✅ Ready"
                    : "❌ Down"
            }</div>

            <div>Log Model: ${
                data.log_model
                    ? "✅ Active"
                    : "❌ Error"
            }</div>

            <div>Patterns: ${
                data.patterns
                    ? "✅ Loaded"
                    : "❌ Missing"
            }</div>
        `;

    } catch {

        target.innerHTML =
            "Health check unavailable";
    }
}