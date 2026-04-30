$(function () {

  var data = window.chartData || [];

  var tanggal = data.map(d => new Date(d.created_at).toISOString().split('T')[0]);
  var co2 = data.map(d => d.co2);
  var nox = data.map(d => d.nox);
  var sox = data.map(d => d.sox);
  var chart = {
  series: [
    { name: "CO2", data: co2 },
    { name: "NOx", data: nox },
    { name: "SOx", data: sox, yAxisIndex: 1 }, // 🔥 pakai axis kedua
  ],

  chart: {
    type: "bar",
    height: 345,
    offsetX: -15,
    toolbar: { show: true },
    foreColor: "#adb0bb",
    fontFamily: 'inherit',
    sparkline: { enabled: false },
  },

  // 🔥 tambah warna khusus SOx
  colors: ["#5D87FF", "#49BEFF", "#FF6B6B"],

  plotOptions: {
    bar: {
      horizontal: false,
      columnWidth: "35%",
      borderRadius: [6],
      borderRadiusApplication: 'end',
      borderRadiusWhenStacked: 'all'
    },
  },

  markers: { size: 0 },

  dataLabels: {
    enabled: false,
  },

  legend: {
    show: true, // 🔥 biar tau mana SOx
  },

  grid: {
    borderColor: "rgba(0,0,0,0.1)",
    strokeDashArray: 3,
    xaxis: {
      lines: { show: false },
    },
  },

  xaxis: {
    type: "category",
    categories: tanggal,
    labels: {
      style: { cssClass: "grey--text lighten-2--text fill-color" },
    },
  },

  // 🔥 INI BAGIAN PENTING
  yaxis: [
    {
      title: { text: "CO2 / NOx" },
      min: 0,
      max: 400,
      labels: {
        style: { cssClass: "grey--text lighten-2--text fill-color" },
      },
    },
    {
      opposite: true, // 🔥 posisi kanan
      title: { text: "SOx" },
      min: 0,
      max: 1, // 🔥 kecil biar kelihatan
      labels: {
        style: { cssClass: "grey--text lighten-2--text fill-color" },
      },
    }
  ],

  stroke: {
    show: true,
    width: 3,
    lineCap: "butt",
    colors: ["transparent"],
  },

  tooltip: { theme: "light" },

  responsive: [
    {
      breakpoint: 600,
      options: {
        plotOptions: {
          bar: {
            borderRadius: 3,
          }
        },
      }
    }
  ]
};

  var chart = new ApexCharts(document.querySelector("#chart"), chart);
  chart.render();


})
