@extends('admin.layout.main')
@section('title', env('APP_NAME') . ' | Category-edit')
@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.css" rel="stylesheet">

    <div class="row justify-content-center">
        <div class="col-lg-11">
            <div class="card">
                <div class="card-title">
                    <h4>Edit Payment</h4>
                    @if (Session::has('message'))
                        <p class="alert alert-info">{{ Session::get('message') }}</p>
                    @endif
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <form action="{{ route('admin.editexpensesPost', encrypt($expenses->id)) }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-md-6">
                                    
                                    <div class="form-group">
                                        <label for="id_end_time">Trabsaction Date:</label>
                                        <div class="input-group date" id="datepicker">
                                            <input type="text" name="transaction_date" class="form-control" value="{{isset($expenses) ? date('d/m/Y', strtotime(trim(str_replace('/', '-', $expenses->transaction_date)))) : '';}}" required>
                                            <div class="input-group-addon input-group-append">
                                                <div class="input-group-text">
                                                    <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                                                </div>
                                            </div>
                                        </div>   
                                    </div>    
                                    
                                    <div class="form-group">
                                        <label>Payment Method</label><span class="text-danger">*</span>
                                        <select name="payment_method" class="form-control" required>
                                            <option value="Credit Card" {{$expenses->payment_method == "Credit Card" ? "selected":""}}>Credit Card</option>
                                            <option value="Cash" {{$expenses->payment_method == "Cash" ? "selected":""}}>Cash</option>
                                            <option value="Debit Card" {{$expenses->payment_method == "Debit Card" ? "selected":""}}>Debit Card</option>
                                            <option value="Check" {{$expenses->payment_method == "Check" ? "selected":""}}>Check</option>
                                            <option value="Zelle" {{$expenses->payment_method == "Zelle" ? "selected":""}}>Zelle</option>
                                            <option value="PayPal" {{$expenses->payment_method == "PayPal" ? "selected":""}}>PayPal</option>
                                            <option value="Venmo" {{$expenses->payment_method == "Venmo" ? "selected":""}}>Venmo</option>
                                        </select>
                                        @error('payment_method')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Amount</label><span class="text-danger">*</span>
                                        <input type="text" class="form-control" name="amount" value="{{$expenses->amount}}" placeholder="Enter amount" required>
                                        @error('amount')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Note</label><span class="text-danger">*</span>
                                        <textarea name="note" class="form-control" required> <?php echo $expenses->note ?></textarea>
                                        @error('note')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Expense Items</label><span class="text-danger">*</span>
                                        <select name="expense_items" class="form-control" required>
                                            <option value="advertising" @if($expenses->expense_items == 'advertising') selected @endif>Advertising</option>
                                            <option value="ink"  @if($expenses->expense_items == 'ink') selected @endif>Ink</option>
                                            <option value="tools"  @if($expenses->expense_items == 'tools') selected @endif>Tools</option>
                                            <option value="clothing"  @if($expenses->expense_items == 'clothing') selected @endif>Clothing</option>
                                            <option value="insurance"  @if($expenses->expense_items == 'insurance') selected @endif>Insurance</option>
                                            <option value="ccfees"  @if($expenses->expense_items == 'ccfees') selected @endif>CC Fees</option>
                                        </select>
                                        @error('expense_items')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                </div>


                            </div>



                        <button type="submit" class="btn btn-default">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @section('script')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>

        <script>
            $(function() {
                $('#datetimepicker1').datetimepicker();
            });

            $('#datepicker').datetimepicker({
                "allowInputToggle": true,
                "showClose": true,
                "showClear": true,
                "showTodayButton": true,
                "format": "DD/MM/YYYY",
            });
        </script>
    @endsection
