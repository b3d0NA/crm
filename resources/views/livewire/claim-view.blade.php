<div class="modal fade bd-example-modal-xl" id="claimViewModal" tabindex="-1" aria-labelledby="myExtraLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">View Claim</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
            </div>
            @if ($isModalOpen)

            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        @if ($claim->is_escalated == 1)
                        <div class="alert alert-warning" role="alert">
                            This claim has escalated after 14 days
                        </div>
                        @else
                        <div class="alert alert-danger" role="alert">
                            User has escalated this claim. Make the decision ASAP!
                        </div>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label for="customerName" class="form-label">Claim Number*</label>
                            <div class="p-2 bg-light text-center text-flickr">
                                <p>{{$claim->claim_no}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label for="customerName" class="form-label">Claimed Date*</label>
                            <div class="p-2 bg-light text-center text-flickr">
                                <p>{{$claim->date->format('d/m/Y')}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="mb-3">
                            <label for="customerName" class="form-label">Customer Name*</label>
                            <input id="customerName" type="text" name="customer_name" minlength="2" class="form-control"
                                readonly value="{{$this->claim->customer_name}}">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email*</label>
                            <input id="email" readonly class="form-control" name="email" type="email"
                                value="{{$this->claim->email}}">
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="mb-3">
                            <label for="registeredBy" class="form-label">Registered by*</label>
                            <input name="registered_by" readonly type="text" required minlength="2" class="form-control"
                                value="{{$claim->registered_by}}">
                        </div>
                    </div>

                </div>
                <div class=" row">
                    <div class="col-sm-4">
                        <div class="mb-3">
                            <label for="salesChannel" class="form-label">Sales channel*</label>
                            <input readonly class="form-control" value="{{$claim->sales_channel}}">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="mb-3">
                            <label class="form-label" for="customerNumber">Customer number*</label>
                            <input readonly class="form-control" value="{{$claim->customer_nr}}">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="mb-3">
                            <label class="form-label" id="customerCountry">Customer country*</label>
                            <input readonly class="form-control" value="{{$claim->customer_country}}">
                        </div>
                    </div>
                </div><!-- Row -->
                <div class="row">
                    <div class="col-sm-4">
                        <div class="mb-3">
                            <label class="form-label" for="itemNumber">Item number*</label>
                            <input readonly class="form-control" value="{{$claim->item_nr}}">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="mb-3">
                            <label for="quantity" class="form-label">Quantity*</label>
                            <input readonly class="form-control" value="{{$claim->quantity}}">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="mb-3">
                            <label class="form-label" for="serialNumber">Serial Number*</label>
                            <input readonly class="form-control" value="{{$claim->serial_nr}}">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        <div class="mb-3">
                            <label class="form-label" for="purchasedDateInp">Purchased date*</label>
                            <input readonly class="form-control" value="{{$claim->purchased_date->format('d/m/Y')}}">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="mb-3">
                            <label for="customerInvoiceNumber" class="form-label">Customer invoice
                                number*</label>
                            <input readonly class="form-control" value="{{$claim->customer_invoice_number}}">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="mb-3">
                            <label class="form-label" for="orderNumber">Order number*</label>
                            <input readonly class="form-control" value="{{$claim->customer_order_number}}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label class="form-label" for="problemDescription">Problem description*</label>
                                <textarea cols="30" class="form-control" readonly
                                    rows="10">{{$claim->problem_description}}</textarea>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label class="form-label" for="failureType">Failure type*</label>
                                <textarea cols="30" class="form-control" readonly
                                    rows="10">{{$claim->failure_type}}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label class="form-label" for="customerOrderDate">Order date*</label>
                                <input readonly class="form-control"
                                    value="{{$claim->customer_order_date->format('d/m/Y')}}">
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="d-flex flex-wrap gap-2 images">
                                @foreach (explode("|", str_replace("public", "", $claim->image)) as $image)
                                <img src="{{asset('storage/'.$image)}}" alt="{{$image}}"
                                    style=" width: 30%;height: 30%;">
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @forelse ( as )
                    
                @empty
                    
                @endforelse
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>