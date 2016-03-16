@extends('admin._misc._admin-layout')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Custom responsive table </h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-wrench"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#">Config option 1</a>
                        </li>
                        <li><a href="#">Config option 2</a>
                        </li>
                    </ul>
                    <a class="close-link">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content">
                <div class="row">
                    <div class="col-sm-5 m-b-xs"><select class="input-sm form-control input-s-sm inline">
                        <option value="0">Option 1</option>
                        <option value="1">Option 2</option>
                        <option value="2">Option 3</option>
                        <option value="3">Option 4</option>
                    </select>
                    </div>
                    <div class="col-sm-4 m-b-xs">
                        <div data-toggle="buttons" class="btn-group">
                            <label class="btn btn-sm btn-white"> <input type="radio" id="option1" name="options"> Day </label>
                            <label class="btn btn-sm btn-white active"> <input type="radio" id="option2" name="options"> Week </label>
                            <label class="btn btn-sm btn-white"> <input type="radio" id="option3" name="options"> Month </label>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="input-group"><input type="text" placeholder="Search" class="input-sm form-control"> <span class="input-group-btn">
                            <button type="button" class="btn btn-sm btn-primary"> Go!</button> </span></div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>

                            <th></th>
                            <th>Project </th>
                            <th>Completed </th>
                            <th>Task</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($items as $item)
                        <tr>
                            <td><input type="checkbox"  checked class="i-checks" name="input[]"></td>
                            <td>Project<small>This is example of project</small></td>
                            <td><span class="pie">0.52/1.561</span></td>
                            <td>20%</td>
                            <td>{{$item->showPubDate()}}</td>
                            <td>
                            	<a href="#"><i class="fa fa-check text-navy"></i></a>
                            	<a href="#"><i class="fa fa-check text-navy"></i></a>
                            	<a href="#"><i class="fa fa-check text-navy"></i></a>
                            </td>
                        </tr>
                       	@endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

</div>
@stop

