<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>compare sel games</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.min.js" integrity="sha512-vBmx0N/uQOXznm/Nbkp7h0P1RfLSj0HQrFSzV8m7rOGyj30fYAOKHYvCNez+yM8IrfnW0TCodDEjRqf6fodf/Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body>
{{--fea,sdsds--}}
    <div style="height: 400px; width: 900px; margin: auto;">
        <canvas id="barChart">
hello world
        </canvas>
    </div>
<script>
    $(function (){
        var datas1 = <?php echo json_encode($all1); ?>;
        var datas2 = <?php echo json_encode($all2); ?>;
        var barCanvas = $("#barChart");
        var barChart = new Chart(barCanvas,{
            type: 'bar',
            data:{
                labels :['NA sales' , 'EU sales' , 'JP sales' , 'Other sales' , 'Global sales'],
                datasets:[
                    {
                        label: 'Compare Sales game 1',
                        data: datas1,
                        backgroundColor:['blue','red','orange','yellow','green']
                    }
                    ,
                    {
                        label: 'Compare Sales game 2',
                        data: datas2,
                        backgroundColor:['blue','red','orange','yellow','green']
                    }
                ]
            },

            options:{
                scales:{
                    yAxes:[{
                        ticks:{
                            beginAtZero:true
                        }
                    }]
                }
            }
        });
    })
</script>

// <script>
//     $(function (){
//         var datas = <?php echo json_encode($all2); ?>;
//         var barCanvas = $("#barChart");
//         var barChart = new Chart(barCanvas,{
//             type: 'bar',
//             data:{
//                 labels :['NA sales' , 'EU sales' , 'JP sales' , 'Other sales' , 'Global sales'],
//                 datasets:[
//                     {
//                         label: 'Compare Sales game 2',
//                         data: datas,
//                         backgroundColor:['blue','red','orange','yellow','green']
//                     }
//                 ]
//             },
//             options:{
//                 scales:{
//                     yAxes:[{
//                         ticks:{
//                             beginAtZero:true
//                         }
//                     }]
//                 }
//             }
//         });
//     })
// </script>
</body>
</html>

