
import {
    log,
    clearConsole
}
from "./console.js";

import {
    runSeeder
}
from "./seeder.js";

console.log(
    "Operations Lab Loaded"
);

log(
    "Operations Lab Ready"
);

document
    .getElementById("clearConsoleBtn")
    ?.addEventListener(
        "click",
        clearConsole
    );

document
    .getElementById("seedBtn")
    ?.addEventListener(
        "click",
        runSeeder
    );

import { simulateIncident }
from "./incidents.js";

document
    .getElementById("simulateBtn")
    ?.addEventListener(
        "click",
        simulateIncident
    );


import { loadHealth }
from "./health.js";

import { loadSnapshot }
from "./snapshot.js";


import {
    loadHistory
}
from "./history.js";

document
    .getElementById("seedBtn")
    .addEventListener(
        "click",
        runSeeder
    );

document
    .getElementById("simulateBtn")
    .addEventListener(
        "click",
        simulateIncident
    );

document
    .getElementById("clearConsoleBtn")
    .addEventListener(
        "click",
        clearConsole
    );

loadHealth();
loadSnapshot();
loadHistory();