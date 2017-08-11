<?php
include 'header2.php'
?>
<div class =container>
<ul class="nav nav-tabs">
  <li role="presentation"><a href="../coba">Data Caption</a></li>
  <li role="presentation" class="active"><a href="../chart">Dashboard Perbincangan</a></li>
  <li role="presentation"><a href="../wordcloud">Word Cloud</a></li>
  <li role="presentaation"><a href="../mapping">Pembagian Wilayah</a></li>
  <li role="presentation"><a href="../akun">Tambah Akun</a></li>
  </ul>
  <br>
<div class="col-xs-12 col-md-11">
        <div class="panel panel-primary">   
            <div  class="panel-heading"> Dashboard Topik Caption </div>

<meta charset="utf-8">

<!DOCTYPE html>

<style>

button {
  position: absolute;
  left: 28px;
  top: 490px;
}

</style>
<div> <select name="klas" class="klas">
        <option value="0">2 Topik</option>
        <option value="1">3 Topik</option>
        <option value="2">4 Topik</option>
        <option value="3">5 Topik</option>
      </select></div>
<button class="btn btn-success" onclick="transition()">Update</button>
<svg width="1000" height="400"></svg>
<script src="https://d3js.org/d3.v4.min.js"></script>
<script>

var n = 20, // number of layers
    m = 200, // number of samples per layer
    k = 10; // number of bumps per layer

var stack = d3.stack().keys(d3.range(n)).offset(d3.stackOffsetWiggle),
    layers0 = stack(d3.transpose(d3.range(n).map(function() { return bumps(m, k); }))),
    layers1 = stack(d3.transpose(d3.range(n).map(function() { return bumps(m, k); }))),
    layers = layers0.concat(layers1);

var svg = d3.select("svg"),
    width = +svg.attr("width"),
    height = +svg.attr("height");

var x = d3.scaleLinear()
    .domain([0, m - 1])
    .range([0, width]);

var y = d3.scaleLinear()
    .domain([d3.min(layers, stackMin), d3.max(layers, stackMax)])
    .range([height, 0]);

var z = d3.interpolateCool;

var area = d3.area()
    .x(function(d, i) { return x(i); })
    .y0(function(d) { return y(d[0]); })
    .y1(function(d) { return y(d[1]); });

svg.selectAll("path")
  .data(layers0)
  .enter().append("path")
    .attr("d", area)
    .attr("fill", function() { return z(Math.random()); });

function stackMax(layer) {
  return d3.max(layer, function(d) { return d[1]; });
}

function stackMin(layer) {
  return d3.min(layer, function(d) { return d[0]; });
}

function transition() {
  var t;
  d3.selectAll("path")
    .data((t = layers1, layers1 = layers0, layers0 = t))
    .transition()
      .duration(2500)
      .attr("d", area);
}

// Inspired by Lee Byron’s test data generator.
function bumps(n, m) {
  var a = [], i;
  for (i = 0; i < n; ++i) a[i] = 0;
  for (i = 0; i < m; ++i) bump(a, n);
  return a;
}

function bump(a, n) {
  var x = 1 / (0.1 + Math.random()),
      y = 2 * Math.random() - 0.5,
      z = 10 / (0.1 + Math.random());
  for (var i = 0; i < n; i++) {
    var w = (i / n - y) * z;
    a[i] += x * Math.exp(-w * w);
  }
}

</script>
