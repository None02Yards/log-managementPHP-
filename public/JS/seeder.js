import { log, clearConsole } from "./console.js";

const API = "/api";

export async function runSeeder() {

    const btn =
        document.getElementById("seedBtn");

    btn.disabled = true;

    clearConsole();

    log("══════════════════════════════════════");
    log("🚀 Seeder Started");
    log("══════════════════════════════════════");

//     try {

//         const res =
//             await fetch(
//                 API + "/seed",
//                 {
//                     method: "POST"
//                 }
//             );

//         const data =
//             await res.json();

//         log("✅ Seeder Completed");

//         log(
//             `Inserted: ${data.result.inserted}`
//         );

//         log(
//             `Failed: ${data.result.failed}`
//         );

//         document
//             .getElementById("stats")
//             .innerHTML = `
//                 <strong>Inserted:</strong>
//                 ${data.result.inserted}
//                 <br>

//                 <strong>Failed:</strong>
//                 ${data.result.failed}
//             `;

//     } catch (e) {

//         log(
//             "❌ Error: " + e.message
//         );
//     }

//     btn.disabled = false;
// }

try {

        const res =
            await fetch(API + "/seed", {
                method: "POST"
            });

        const data =
            await res.json();

        log("📝 Creating database and tables...");
        log("📥 Inserting sample logs...");
        log("────────────────────────────");

        log("🟢 [INFO] Application started");
        log("🟢 [INFO] Database connected");
        log("🟡 [WARNING] Slow query detected");
        log("🔴 [ERROR] Failed API request");
        log("🔴 [CRITICAL] Unauthorized access");

        log("────────────────────────────");
        log("✅ Setup Complete");

        document
            .getElementById("stats")
            .innerHTML = `
                <strong>Inserted:</strong>
                ${data.result.inserted}
                <br>
                <strong>Failed:</strong>
                ${data.result.failed}
            `;

    } catch (e) {

        log("❌ Error: " + e.message);

    }

    btn.disabled = false;
}