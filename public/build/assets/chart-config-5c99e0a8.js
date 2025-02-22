$(document).ready(function () {

//Resultado de Mensual Test de Bowie & Dick / Vacío linechart

    let e = document.getElementById("testBowiesChart"); $.get("/testbowies/chart-data", function (a) { new Chart(e, { type: "line", data: { labels: a.months, datasets: [{ label: "TBD -", data: a.TBDNeg, fill: !1, borderColor: "#2563EB", backgroundColor: ['#2563EB'], tension: 0 }, { label: "TBD +", data: a.TBDPosi, fill: !1, borderColor: "#EA580C", backgroundColor: ['#EA580C'], tension: 0 }, { label: "Test V OK", data: a.testvacNeg, fill: !1, borderColor: "#35eb1f", backgroundColor: ['#35eb1f'], tension: 0 }, { label: "Test V Falla'", data: a.testvacPosi, fill: !1, borderColor: "#eb881f", backgroundColor: ['#eb881f'], tension: 0 }] } }) })

   // Resultado de Test de Bowie & Dick / Vacío PIECHART
    let t = document.getElementById("currentMonthChart"); $.get("/current-month/chart-data", function (a) { new Chart(t, { type: "pie", data: { labels: ["TBD -", "TBD +",], datasets: [{ data: [a.testbdoks, a.testbdfails], backgroundColor: ["#16b32e", "#c53929"], hoverBackgroundColor: ["#16b32e", "#c53929", "#1f4ec3", '#eb881f'] }] } }) });
    let tt = document.getElementById("currentMonthChart2"); $.get("/current-month/chart-data", function (a) {
        new Chart(tt, {
            type: "pie", data: {
                labels: ["Test V ok", "Test V Falla"], datasets: [{ data: [a.testvacuumoks, a.testvacuumfails], backgroundColor: ["#1f4ec3", '#eb881f'], hoverBackgroundColor: ["#16b32e", "#c53929", "#1f4ec3", '#eb881f'] }]
            }
        })
    });

    // Producción Mensual Esterilización.
    let r = document.getElementById("ProductionsChart"); $.get("/productions/chart-data", function (a) { new Chart(r, { type: "line", data: { labels: a.months, datasets: [{ label: "V1 OK", data: a.Ciclos_ok1, fill: !1, borderColor: "#2563EB", backgroundColor: ['#2563EB'], tension: 0 }, { label: "V1 FALLA", data: a.Ciclos_Fails1, fill: !1, borderColor: "#EA580C", backgroundColor: ['#EA580C'], tension: 0 }, { label: "V2 OK", data: a.Ciclos_ok2, fill: !1, borderColor: "#35eb1f", backgroundColor: ['#35eb1f'], tension: 0 }, { label: "V2 FALLA", data: a.Ciclos_Fails2, fill: !1, borderColor: "#eb881f", backgroundColor: ['#eb881f'], tension: 0 }, { label: "HPO OK", data: a.Ciclos_HPO_ok, fill: !1, borderColor: "#19aac4", backgroundColor: ['#19aac4'], tension: 0 }, { label: "HPO FALLA", data: a.Ciclos_HPO_fail, fill: !1, borderColor: "#7627c6", backgroundColor: ['#7627c6'], tension: 0 }] } }) })


    // Producción Total Esterilización.
    let c = document.getElementById("currentMonthProductionChart"); $.get("/currentProducMonth/chart-data", function (a) { new Chart(c, { type: "pie", data: { labels: ["V1 ok", "V1 Falla", "V2 ok", "V2 Falla"], datasets: [{ data: [a.Steam1ok, a.Steam1fail, a.Steam2ok, a.Steam2fail], backgroundColor: ["#2563EB", "#EA580C", "#35eb1f", "#eb881f"], hoverBackgroundColor: ["#16b32e", "#c53929", "#1f4ec3", '#eb881f'] }] } }) });

    let d = document.getElementById("currentMonthProductionChart2"); $.get("/currentProducMonth/chart-data", function (a) { new Chart(d, { type: "pie", data: { labels: ["HPO 1 ok", "HPO 1 Falla"], datasets: [{ data: [a.HPO_OK, a.HPO_FAIL], backgroundColor: ["#19aac4", "#7627c6"], hoverBackgroundColor: ["#16b32e", "#c53929", "#1f4ec3", '#eb881f'] }] } }) });


    // Instrumental Procesado.
    let s = document.getElementById("ProductionlabelsChart"); $.get("/productionlabels/chart-data", function (a) { new Chart(s, { type: "line", data: { labels: a.months, datasets: [{ label: "Instrumental Vapor", data: a.label_steams, fill: !1, borderColor: "#eb881f", backgroundColor: ['#eb881f'], tension: 0 }, { label: "Instrumental Peroxido", data: a.label_hpos, fill: !1, borderColor: "#19aac4", backgroundColor: ['#19aac4'], tension: 0 }] } }) })



    // Rendimiento Paquetes.
    let ss = document.getElementById("ResultProductionChart"); $.get("/resultproductions/chart-data", function (a) { new Chart(ss, { type: "line", data: { labels: a.months, datasets: [{ label: "Instrumental Procesado", data: a.procesado_all, fill: !1, borderColor: "#eb881f", backgroundColor: ['#eb881f'], tension: 0 }, { label: "Instrumental Esteril", data: a.esteril_all, fill: !1, borderColor: "#19aac4", backgroundColor: ['#19aac4'], tension: 0 }]    } }) })
   


    // Resultado de liberación del Biologicos.

    let u = document.getElementById("BiologicChart"); $.get("/biologics/chart-data", function (a) { new Chart(u, { type: "line", data: { labels: a.months, datasets: [{ label: "Steam Biologico OK", data: a.Ciclos_BioSteam_OK, fill: !1, borderColor: "#2563EB", backgroundColor: ['#2563EB'], tension: 0 }, { label: "Steam Biologico FALLA", data: a.Ciclos_BioSteam_FAIL, fill: !1, borderColor: "#EA580C", backgroundColor: ['#EA580C'], tension: 0 }, { label: "HPO Biologico OK", data: a.Ciclos_BioHPO_OK, fill: !1, backgroundColor: ['#35eb1f'], borderColor: "#35eb1f", tension: 0 }, { label: "HPO Biologico FALLA", data: a.Ciclos_BioHPO_fail, fill: !1, backgroundColor: ['#eb881f'], borderColor: "#eb881f", tension: 0 }] } }) })


    // Rendimiento Areas Central.
    
    let v = document.getElementById("CentralChart"); $.get("/central/chart-data", function (a) { new Chart(v, { type: "line", data: { labels: a.months, datasets: [{ label: "Recepción", data: a.Ciclos_Receptions, fill: !1, borderColor: "#2563EB", backgroundColor: ['#2563EB'], tension: 0 }, { label: "Producción", data: a.Ciclos_Labelqr, fill: !1, borderColor: "#EA580C", backgroundColor: ['#EA580C'], tension: 0 }, { label: "Despachos", data: a.Ciclos_Expeditions, fill: !1, borderColor: "#35eb1f", backgroundColor: ['#35eb1f'], tension: 0 }] } }) })

});

