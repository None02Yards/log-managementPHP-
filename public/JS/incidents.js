import { log } from "./console.js";

const API = "/api";

export async function simulateIncident() {

    const type =
        document.getElementById("incidentType")
        .value;

    const formData =
        new FormData();

    formData.append(
        "type",
        type
    );

    log("");
    log("⚠ Incident Simulation Requested");
    log(`Scenario: ${type}`);
    log("────────────────────────────");

    try {

        const res =
            await fetch(
                API + "/simulate",
                {
                    method: "POST",
                    body: formData
                }
            );

        const data =
            await res.json();

        if (!data.success) {

            throw new Error(
                "Simulation failed"
            );
        }

        data.logs.forEach(item => {

            log(item);

        });

        log("────────────────────────────");
        log("✅ Incident Completed");

    } catch (e) {

        log(
            "❌ Incident Error: "
            + e.message
        );
    }
}