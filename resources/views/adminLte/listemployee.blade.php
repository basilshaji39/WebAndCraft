@include('Layouts.header')

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        @include('Layouts.mainnavbar')

        @include('Layouts.sidenavbar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @include('Layouts.contentheader')
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    @if (session('successmsg'))
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="alert alert-success alert-dismissible">
                                            <button type="button" class="close" data-dismiss="alert"
                                                aria-hidden="true">×</button>
                                            <p style="text-align: center">{{ session('successmsg') }}</p>
                                        </div>

                                    </div>
                                </div>
                             @endif
                    <!-- SELECT2 EXAMPLE -->
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">{{ $card_title }}</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="myTable" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Designation</th>
                                        <th>Image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($emp_tbl as $table)
                                        <tr>
                                            <td>{{ $table->id }}</td>
                                            <td>{{ $table->name }}</td>
                                            <td>{{ $table->email }}</td>
                                            <td>{{ $table->designation }}</td>
                                            <td><img src="{{ asset('storage/images/' . $table->image) }}" alt=""
                                                    width="100%" height="100px"></td>
                                            <td>
                                                <a href="/employee/{{ $table->id }}/edit"
                                                    class="btn btn-warning ">Edit</a><br>
                                                <form method="post" action="/employee/{{ $table->id }}">
                                                    @csrf
                                                    @method("DELETE")
                                                    <button onclick="return confirm('Are You Sure ?');"
                                                        class="btn btn-danger">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- /.row -->
                    </div>
                    <!-- /.card-body -->

                </div>
        </div>
        <!-- /.container-fluid -->
        </form>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    @include('Layouts.tempfooter')
    </div>
    <!-- ./wrapper -->
    @include('Layouts.footer')
