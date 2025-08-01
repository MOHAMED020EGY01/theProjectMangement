//Bar Charts

const xValues = chart.map(task => task.status);
const yValues = chart.map(task => task.count);
const barColors = ["red", "green","blue"];

new Chart("PinChart", {
  type: "bar",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
});

