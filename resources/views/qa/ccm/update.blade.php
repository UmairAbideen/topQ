@extends('qa.layout.app')

@section('title')
    Change Control Management
@endsection

@section('page-name')
    Change Control Management
@endsection

@section('active-link-ccm')
    active bg-gradient-primary
@endsection

@section('main-content')
    <div class="container-fluid py-2">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 my-0 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Update Change Request</h6>
                        </div>

                        <div class="d-flex justify-content-end pe-0 pt-4">
                            <a href="{{ route('qa.ccm.view') }}" class="btn bg-gradient-info" role="button"
                                aria-pressed="true">Go
                                Back</a>
                        </div>

                        <form class='px-3' action="{{ route('qa.ccm.update', $change->id) }}" method="post">
                            @csrf
                            @if (session('status'))
                                <div class="alert alert-success alert-dismissible text-white fade show" role="alert">
                                    <small>{{ session('status') }}</small>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            <div class="row">

                                @if (!is_null($change->initiator_name) && is_null($change->verifier_name))
                                    <p class="ps-3 pt-5 pb-2"><b>Description of Change</b></p>

                                    <div class="col-md-6 px-3">
                                        <div class="input-group input-group-static mb-4">
                                            <label>Description</label>
                                            <input type="text" name="description" class="form-control"
                                                value="{{ old('description', $change->description) }}">
                                            @error('description')
                                                <div class="text-danger small">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 px-3">
                                        <div class="input-group input-group-static mb-4">
                                            <label>Justification</label>
                                            <input type="text" name="justification" class="form-control"
                                                value="{{ old('justification', $change->justification) }}">
                                            @error('justification')
                                                <div class="text-danger small">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 px-3">
                                        <div class="input-group input-group-static mb-4">
                                            <label>Area</label>
                                            <input type="text" name="area" class="form-control"
                                                value="{{ old('area', $change->area) }}">
                                            @error('area')
                                                <div class="text-danger small">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 px-3">
                                        <div class="input-group input-group-static mb-4">
                                            <label>Impact</label>
                                            <input type="text" name="impact" class="form-control"
                                                value="{{ old('impact', $change->impact) }}">
                                            @error('impact')
                                                <div class="text-danger small">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4 px-3">
                                        <div class="input-group input-group-static mb-4">
                                            <label>Action # 1</label>
                                            <input type="text" name="action1" class="form-control"
                                                value="{{ old('action1', $change->action1) }}">
                                            @error('action1')
                                                <div class="text-danger small">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4 px-3">
                                        <div class="input-group input-group-static mb-4">
                                            <label>Action # 2</label>
                                            <input type="text" name="action2" class="form-control"
                                                value="{{ old('action2', $change->action2) }}">
                                            @error('action2')
                                                <div class="text-danger small">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4 px-3">
                                        <div class="input-group input-group-static mb-4">
                                            <label>Action # 3</label>
                                            <input type="text" name="action3" class="form-control"
                                                value="{{ old('action3', $change->action3) }}">
                                            @error('action3')
                                                <div class="text-danger small">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-2 px-3">
                                        <div class="input-group input-group-static mb-4">
                                            <label class="ms-0">Priority</label>
                                            <select class="form-control" name="priority">
                                                <option value="Low"
                                                    {{ old('priority', $change->priority) == 'Low' ? 'selected' : '' }}>Low
                                                </option>
                                                <option value="Medium"
                                                    {{ old('priority', $change->priority) == 'Medium' ? 'selected' : '' }}>
                                                    Medium</option>
                                                <option value="High"
                                                    {{ old('priority', $change->priority) == 'High' ? 'selected' : '' }}>
                                                    High
                                                </option>
                                            </select>
                                            @error('priority')
                                                <div class="text-danger small">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-2 px-3">
                                        <div class="input-group input-group-static mb-4">
                                            <label>Required Date</label>
                                            <input type="date" name="required_date" class="form-control"
                                                value="{{ old('required_date', $change->required_date) }}">
                                            @error('required_date')
                                                <div class="text-danger small">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <p class="ps-3 pt-5 pb-2"><b>Dcouments Effected By Change</b></p>

                                    <div class="col-md-4 px-3">
                                        <div class="input-group input-group-static mb-4">
                                            <label>Document Effected Name # 1</label>
                                            <input type="text" name="effected_doc1" class="form-control"
                                                value="{{ old('effected_doc1', $change->effected_doc1) }}">
                                            @error('effected_doc1')
                                                <div class="text-danger small">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-2 px-3">
                                        <div class="input-group input-group-static mb-4">
                                            <label>Document Number # 1</label>
                                            <input type="text" name="doc_no1" class="form-control"
                                                value="{{ old('doc_no1', $change->doc_no1) }}">
                                            @error('doc_no1')
                                                <div class="text-danger small">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4 px-3">
                                        <div class="input-group input-group-static mb-4">
                                            <label>Document Effected Name # 2</label>
                                            <input type="text" name="effected_doc2" class="form-control"
                                                value="{{ old('effected_doc2', $change->effected_doc2) }}">
                                            @error('effected_doc2')
                                                <div class="text-danger small">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-2 px-3">
                                        <div class="input-group input-group-static mb-4">
                                            <label>Document Number # 2</label>
                                            <input type="text" name="doc_no2" class="form-control"
                                                value="{{ old('doc_no2', $change->doc_no2) }}">
                                            @error('doc_no2')
                                                <div class="text-danger small">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4 px-3">
                                        <div class="input-group input-group-static mb-4">
                                            <label>Document Effected Name # 3</label>
                                            <input type="text" name="effected_doc3" class="form-control"
                                                value="{{ old('effected_doc3', $change->effected_doc3) }}">
                                            @error('effected_doc3')
                                                <div class="text-danger small">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-2 px-3">
                                        <div class="input-group input-group-static mb-4">
                                            <label>Document Number # 3</label>
                                            <input type="text" name="doc_no3" class="form-control"
                                                value="{{ old('doc_no3', $change->doc_no3) }}">
                                            @error('doc_no3')
                                                <div class="text-danger small">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                @elseif (!is_null($change->verifier_name) && is_null($change->approver_name))
                                    <p class="ps-3 pt-5 pb-2"><b>Evalutaion of Change</b> (By QA)</p>

                                    <div class="col-md-2 px-3">
                                        <div class="input-group input-group-static mb-4">
                                            <label>Classification</label>
                                            <select class="form-control" name="classification">
                                                <option selected disabled>--- Select Classification ---</option>
                                                <option value="Minor"
                                                    {{ old('classification', $change->classification) == 'Minor' ? 'selected' : '' }}>
                                                    Minor</option>
                                                <option value="Major"
                                                    {{ old('classification', $change->classification) == 'Major' ? 'selected' : '' }}>
                                                    Major</option>
                                            </select>
                                            @error('classification')
                                                <div class="text-danger small">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>


                                    <p class="ps-3 pt-5 pb-2"><b>Evalutaion of Change</b> (By Committee)</p>

                                    @php
                                        $reviewerNames = [
                                            'Ayub Ismail',
                                            'Hassan Khatri',
                                            'Muhammad Faisal',
                                            'Akhtar Safi',
                                            'Faisal Khan',
                                            'Babar Khan',
                                            'Zain Nasir',
                                            'Muhammad Umair',
                                        ];
                                    @endphp

                                    @for ($i = 1; $i <= 3; $i++)
                                        <div class="col-md-3 px-3">
                                            <div class="input-group input-group-static mb-4">
                                                <label>Reviewer Name #{{ $i }}</label>
                                                <select class="form-control" name="reviewer_name{{ $i }}">
                                                    <option selected value="">--- Select Reviewer Name ---</option>
                                                    @foreach ($reviewerNames as $name)
                                                        <option value="{{ $name }}"
                                                            {{ old('reviewer_name' . $i, $change->{'reviewer_name' . $i}) == $name ? 'selected' : '' }}>
                                                            {{ $name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('reviewer_name' . $i)
                                                    <div class="text-danger small">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-9 px-3">
                                            <div class="input-group input-group-static mb-4">
                                                <label>Recommendation #{{ $i }}</label>
                                                <input type="text" name="recommendation{{ $i }}"
                                                    class="form-control"
                                                    value="{{ old('recommendation' . $i, $change->{'recommendation' . $i}) }}">
                                                @error('recommendation' . $i)
                                                    <div class="text-danger small">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    @endfor
                                @elseif (!is_null($change->approver_name) && is_null($change->closer_name))
                                    @if ($change->department === 'QA')
                                        <p class="ps-3 pt-5 pb-2"><b>Implementation</b></p>

                                        @for ($i = 1; $i <= 3; $i++)
                                            <div class="col-md-8 px-3">
                                                <div class="input-group input-group-static mb-4">
                                                    <label>Task #{{ $i }}</label>
                                                    <input type="text" name="task{{ $i }}"
                                                        class="form-control"
                                                        value="{{ old('task' . $i, $change->{'task' . $i}) }}">
                                                    @error('task' . $i)
                                                        <div class="text-danger small">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-2 px-3">
                                                <div class="input-group input-group-static mb-4">
                                                    <label>Responsible Person #{{ $i }}</label>
                                                    <input type="text" name="responsible{{ $i }}"
                                                        class="form-control"
                                                        value="{{ old('responsible' . $i, $change->{'responsible' . $i}) }}">
                                                    @error('responsible' . $i)
                                                        <div class="text-danger small">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-2 px-3">
                                                <div class="input-group input-group-static mb-4">
                                                    <label>Completion Date #{{ $i }}</label>
                                                    <input type="date" name="completion_date{{ $i }}"
                                                        class="form-control"
                                                        value="{{ old('completion_date' . $i, $change->{'completion_date' . $i}) }}">
                                                    @error('completion_date' . $i)
                                                        <div class="text-danger small">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        @endfor

                                        <div class="col-md-6 px-3">
                                            <div class="input-group input-group-static mb-4">
                                                <label>Summary</label>
                                                <input type="text" name="summary" class="form-control"
                                                    value="{{ old('summary', $change->summary) }}">
                                                @error('summary')
                                                    <div class="text-danger small">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-2 px-3">
                                            <div class="input-group input-group-static mb-4">
                                                <label>Implementation Date</label>
                                                <input type="date" name="implementation_date" class="form-control"
                                                    value="{{ old('implementation_date', $change->implementation_date) }}">
                                                @error('implementation_date')
                                                    <div class="text-danger small">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    @endif


                                    <p class="ps-3 pt-5 pb-2"><b>Change Close-out</b></p>

                                    <div class="col-md-6 px-3">
                                        <div class="input-group input-group-static mb-4">
                                            <label>Final Assessment</label>
                                            <input type="text" name="final_assessment" class="form-control"
                                                value="{{ old('final_assessment', $change->final_assessment) }}">
                                            @error('final_assessment')
                                                <div class="text-danger small">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 px-3">
                                        <div class="input-group input-group-static mb-4">
                                            <label>Monitoring (if Required)</label>
                                            <input type="text" name="monitoring" class="form-control"
                                                value="{{ old('monitoring', $change->monitoring) }}">
                                            @error('monitoring')
                                                <div class="text-danger small">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                @endif

                                <div class="mt-3">
                                    <button type="submit" class="btn bg-gradient-success">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
