<canvas  id="myChart"></canvas>

<?php 
$result = datadoanhso($conn);
if(isset($result)) {
    while ($row = mysqli_fetch_array($result)) {
        $data[] = array('x' => $row['ngay'], 'y' => $row['tong_tien']);
    }
    if(isset($data)){
        $data_json = json_encode($data);
    }
    
}
$result1 = datasoluongban($conn);
if(isset($result1)) {
    while ($row1 = mysqli_fetch_array($result1)) {
        $data1[] = array('x' => $row1['ngay'], 'y' => $row1['tong_so_luong']);
    }
    if(isset($data1)){
        $data_json1 = json_encode($data1);
    }
}
?>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Lấy thẻ canvas và lưu nó vào biến context
var ctx = document.getElementById('myChart').getContext('2d');
// Lấy ngày hiện tại
var today = new Date();

// Tạo một đối tượng ngày với ngày đầu tiên của tháng hiện tại
var firstDayOfMonth = new Date(today.getFullYear(), today.getMonth(), 1);

// Tạo một mảng các đối tượng ngày từ ngày đầu tiên của tháng đến ngày hiện tại
var days = [];
for (var d = firstDayOfMonth; d <= today; d.setDate(d.getDate() + 1)) {
  var day = d.getDate().toString().padStart(2, '0'); // Lấy ngày và thêm số 0 vào đầu nếu cần
  var month = (d.getMonth() + 1).toString().padStart(2, '0'); // Lấy tháng và thêm số 0 vào đầu nếu cần
  var label = day + '.' + month; // Định dạng label
  days.push({x: label, y: 0}); // Thêm vào mảng days
}

// Hiển thị danh sách các ngày
var day_format= []
for (var i = 0; i < days.length; i++) {
    day_format.push(days[i].x)
}

// Lấy dữ liệu cho doanh số 
var chartData = JSON.parse('<?php echo $data_json; ?>');
// Lấy dữ liệu cho số lượng bán
var chartData1 = JSON.parse('<?php echo $data_json1; ?>');
// Giải mã chuỗi JSON và gán cho biến chartData
// Khai báo dữ liệu cho biểu đồ

var data = {
    labels: day_format,
    datasets: [{
        label: 'Doanh số ',
        data: chartData,
        backgroundColor: 'rgba(255, 99, 132, 0.2)',
        borderColor: 'rgba(255, 99, 132, 1)',
        borderWidth: 3,
        yAxisID: '2-y'
    },{
        label: 'Số lương bán',
        data: chartData1,
        borderColor: 'rgba(54, 162, 235, 1)',
        borderWidth: 3,
        yAxisID: '1-y'
    }]
};
var options = {
    scales: {
        yAxes: [
            {
                id: '2-y',
                type: 'linear',
                position: 'right',
                ticks: {
                    min: 0,
                    max: 120,
                    stepSize: 20
                }
            },
            {
                id: '1-y',
                type: 'linear',
                position: 'left',
                ticks: {
                    min: 0,
                    max: 120,
                    stepSize: 20
                }
            }
        ]
    }
};
// Khởi tạo biểu đồ
var myChart = new Chart(ctx, {
  type: 'bar',
  data: data,
  options: options
});
    </script>