<title>Kế hoạch công việc hàng ngày</title>

<div class="container-fluid">
    <div class="row p-0">
        <div class="col-12 dongho" id="dongho">
            <div id="thoi_gian">
                <div id="ngaythangnam"></div><br>

                <span id="gio">00</span><span class="haicham"> : </span>
                <span id="phut">00</span><span class="haicham"> : </span>
                <span id="giay">00</span>

            </div>
        </div>
    </div>
    <div class="row mt-2 row ">
        <div class="col-md-4 px-3 ">
            <div class="card w-100 shadow rounded">
                <div class="card-header bg-info text-light">
                    <h3>Chưa thực hiện</h3>
                </div>
                <div class="card-body overflow-auto" ondrop="dropcth(event)" ondragover="allowDrop(event)" id="chuathuchien" style="background-color: #B0c2c5; height: 30rem;">

                </div>
            </div>
        </div>
        <div class="col-md-4 px-3 ">
            <div class="card w-100 shadow rounded">
                <div class="card-header bg-warning text-light">
                    <h3>Đang thực hiện</h3>
                </div>
                <div class="card-body overflow-auto" ondrop="dropdth(event)" ondragover="allowDrop(event)" id="dangthuchien" style="background-color: #B0c2c5; height: 30rem;">

                </div>
            </div>
        </div>
        <div class="col-md-4 px-3 ">
            <div class="card w-100 shadow rounded">
                <div class="card-header bg-success text-light">
                    <h3>Đã hoàn thành</h3>
                </div>
                <div class="card-body overflow-auto" ondrop="dropht(event)" ondragover="allowDrop(event)" id="hoanthanh" style="background-color: #B0c2c5; height: 30rem;">

                </div>
            </div>
        </div>
    </div>
</div>