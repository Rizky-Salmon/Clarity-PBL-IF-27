var ctx = document.getElementById("myLingkaranChart");
var xValues = ["Ronaldo", "Messi", "Neymar", "Mbappe", "Neymar", "Rendi"];
var yValues = [10, 10, 10, 10, 10, 10];
var barColors = [
    "#b91d47",
    "#00aba9",
    "#2b5797",
    "#e8c3b9",
    "#1e7145",
    "#fbbf24"
];

new Chart("myPercentageChart", {
    type: "pie",
    data: {
        labels: xValues,
        datasets: [{
            backgroundColor: barColors,
            data: yValues
        }]
    },
    options: {
        title: {
            display: true,
            text: "10%",
            fontSize: 25
        }
    }
});
