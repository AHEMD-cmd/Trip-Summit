@extends('admin.layout.master')
@section('main_content')
@include('admin.layout.nav')
@include('admin.layout.sidebar')
<div class="main-content">
    <section class="section">
        <div class="section-header justify-content-between">
            <h1>FAQs of {{ $package->name }}</h1>
            <div class="ml-auto">
                <a href="{{ route('packages.index') }}" class="btn btn-primary"><i class="fas fa-plus"></i> back to previous</a>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Question</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($package->faqs as $faq)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $faq->question }}</td>
                                           
                                            <td>
                                                <form action="{{ route('packages.faqs.destroy', ['package' => $package->id, 'faq' => $faq->id]) }}"
                                                    method="POST" class="delete-form" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="fas fa-trash"></i> 
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>

                                        <!-- Modal for each FAQ -->
                                        <div class="modal fade" id="answerModal{{ $faq->id }}" tabindex="-1" role="dialog" aria-labelledby="answerModalLabel{{ $faq->id }}" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="answerModalLabel{{ $faq->id }}">Answer</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <!-- Form to edit the answer -->
                                                        <form id="editAnswerForm{{ $faq->id }}" action="{{ route('packages.faqs.update', ['package' => $package->id, 'faq' => $faq->id]) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="form-group">
                                                                <label for="answer{{ $faq->id }}">Answer</label>
                                                                <textarea name="answer" id="answer{{ $faq->id }}" class="form-control" rows="30" style="height: 200px;">{{ $faq->answer }}</textarea>
                                                            </div>
                                                            <div class="form-group text-right">
                                                                <button type="submit" class="btn btn-primary">Save Changes</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="col-md-5">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('packages.faqs.store', $package->id) }}" method="post">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Question *</label>
                                    <input type="text" name="question" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Answer *</label>
                                    <textarea name="answer" class="form-control h_200" rows="5"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"></label>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>











@endsection
