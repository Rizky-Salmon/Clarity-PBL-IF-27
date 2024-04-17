var ctx = document.getElementById("myLingkaranChart");
var xValues = ["Ronaldo", "Messi", "Neymar", "Mbappe", "Neymar", "Rendi"];
var yValues = [55, 49, 44, 24, 15, 10];
var barColors = [
    "#b91d47",
    "#00aba9",
    "#2b5797",
    "#e8c3b9",
    "#1e7145",
    "#fbbf24"
];

new Chart("myChart", {
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
            text: "To The Isekai World",
            fontSize: 25
        }
    }
});
