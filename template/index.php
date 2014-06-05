<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Телеконтакт - Тестовое задание</title>

    <link href="<?=$baseUrl?>template/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=$baseUrl?>template/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="<?=$baseUrl?>template/css/sb-admin.css" rel="stylesheet">

</head>

<body>
	<input type="hidden" id="baseurl" value="<?=$baseUrl?>"/>
    <div id="wrapper">

        <nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <a class="navbar-brand" href="index.html">Телеконтакт</a>
            </div>
            <!-- /.navbar-header --> 
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Колл-центр</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bell fa-fw"></i>Получить номер для звонка:
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                          <h2 id='timer' style="margin0:auto; text-align:center; display:none; ">До автоматического обновления: <b id='#sec'><?=CALL_INTERVAL;?></b> сек</h2>
                          <table class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>Контакт</th>
                                    <th>Телефон</th>
                                    <th>Индификатор статуса</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr id="appendHere">
                                </tr>
                                 </tbody>
                            </table>
                            <button type="button" class="btn btn-primary btn-lg btn-block" id="next">Получить номер / взять следующий / применить измения</button>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                 </div>
                <!-- /.col-lg-8 -->
                <div class="col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Нужны номера со следующим статусом:
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
	                        <div class="form-group">
	                                	<select multiple="" class="form-control" id="stateIds">
	                                    <option value="0" selected="true">0 - Этому контакту мы еще не звонили</option>
	                                    <option value="2">2 - Был занят</option>
	                                    <option value="3">3 - Небыло ответа</option>
	                                    <option value="4"> 4 - Просили перезвонить</option>
	                                </select>
	                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                  </div>
                </div>
                	            <div class="bg-danger" style="padding:10px">
    <h4>Важно</h4>
    <p>Статусы:<code>1 - контакт закрыт</code> и <code>5 - отказ от разговора</code> доступны лишь для установки. <br>
    После принятия изменения их уже нельзя будет выбрать.
    </p>
  </div>
                <!-- /.col-lg-4 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <script src="<?=$baseUrl?>template/js/jquery-1.10.2.js"></script>
    <script src="<?=$baseUrl?>template/js/bootstrap.min.js"></script>
    <script src="<?=$baseUrl?>template/js/call.js"></script>
</body>

</html>
