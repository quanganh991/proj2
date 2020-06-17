@extends('admin.welcomeAdmin')
@section('all_branch_category')
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Thống Kê Doanh Số Bán Hàng</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <?php
                        $date = array();
                        $van_phong_pham = array();
                        $thieu_nhi = array();
                        $van_hoc = array();
                        $tam_ly_doi_song = array();
                        $khoa_hoc = array();
                        $chinh_tri_LS = array();
                        $tham_khao = array();
                        $theOthers = array();
                        ?>
                        @foreach ($revenue as $eachOfrevenue)
                            <?php
                            $date[] = $eachOfrevenue->date;
                            $van_phong_pham[] = $eachOfrevenue->van_phong_pham;
                            $thieu_nhi[] = $eachOfrevenue->thieu_nhi;
                            $van_hoc[] = $eachOfrevenue->van_hoc;
                            $tam_ly_doi_song[] = $eachOfrevenue->tam_ly_doi_song;
                            $khoa_hoc[] = $eachOfrevenue->khoa_hoc;
                            $chinh_tri_LS[] = $eachOfrevenue->chinh_tri_lich_su;
                            $tham_khao[] = $eachOfrevenue->tham_khao;
                            $theOthers[] = $eachOfrevenue->the_others;
                            ?>
                        @endforeach

                        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                        <script type="text/javascript">
                            google.charts.load('current', {'packages': ['corechart']});
                            google.charts.setOnLoadCallback(drawVisualization);

                            var table = [
                                ['Thời gian', 'VP phẩm', 'Thiếu nhi', 'Văn học', 'Tâm lý đời sống', 'Khoa học','Chính trị LS','Tham khảo', 'Khác'],
                                ['<?php echo $date[0] ?>',<?php echo $van_phong_pham[0] ?>,<?php echo $thieu_nhi[0] ?>,<?php echo $van_hoc[0] ?>,<?php echo $tam_ly_doi_song[0] ?>,<?php echo $khoa_hoc[0] ?>,<?php echo $chinh_tri_LS[0] ?>,<?php echo $tham_khao[0] ?>,<?php echo $theOthers[0] ?>],
                                ['<?php echo $date[1] ?>',<?php echo $van_phong_pham[1] ?>,<?php echo $thieu_nhi[1] ?>,<?php echo $van_hoc[1] ?>,<?php echo $tam_ly_doi_song[1] ?>,<?php echo $khoa_hoc[1] ?>,<?php echo $chinh_tri_LS[1] ?>,<?php echo $tham_khao[1] ?>,<?php echo $theOthers[1] ?>],
                                ['<?php echo $date[2] ?>',<?php echo $van_phong_pham[2] ?>,<?php echo $thieu_nhi[2] ?>,<?php echo $van_hoc[2] ?>,<?php echo $tam_ly_doi_song[2] ?>,<?php echo $khoa_hoc[2] ?>,<?php echo $chinh_tri_LS[2] ?>,<?php echo $tham_khao[2] ?>,<?php echo $theOthers[2] ?>],
                                ['<?php echo $date[3] ?>',<?php echo $van_phong_pham[3] ?>,<?php echo $thieu_nhi[3] ?>,<?php echo $van_hoc[3] ?>,<?php echo $tam_ly_doi_song[3] ?>,<?php echo $khoa_hoc[3] ?>,<?php echo $chinh_tri_LS[3] ?>,<?php echo $tham_khao[3] ?>,<?php echo $theOthers[3] ?>],
                                ['<?php echo $date[4] ?>',<?php echo $van_phong_pham[4] ?>,<?php echo $thieu_nhi[4] ?>,<?php echo $van_hoc[4] ?>,<?php echo $tam_ly_doi_song[4] ?>,<?php echo $khoa_hoc[4] ?>,<?php echo $chinh_tri_LS[4] ?>,<?php echo $tham_khao[4] ?>,<?php echo $theOthers[4] ?>]
                            ];

                            function drawVisualization() {
                                // Some raw data (not necessarily accurate)
                                var data = google.visualization.arrayToDataTable(table);

                                var options = {
                                    title: 'Thống kê doanh thu BookShop',
                                    vAxis: {title: 'Doanh thu'},     //trục Oy
                                    hAxis: {title: 'Thời gian'},    //trục Ox
                                    seriesType: 'bars',
                                    series: {0: {type: 'line'}, 7: {type: 'line'}}
                                };

                                var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
                                chart.draw(data, options);
                            }
                        </script>
                        </head>
                        <body>
                        <div id="chart_div" style="width: 1150px; height: 500px;"></div>
                        </body>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </section>
@endsection
