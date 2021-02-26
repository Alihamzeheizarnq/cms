@section('title' ,'ایجاد محصول')
@component('admin.layouts.content' , ['title' => 'ایجاد محصول'])

    @slot('script')
        <script>
            $('#categories').select2({
                'placeholder': 'دسترسی مورد نظر را انتخاب کنید'
            });

            let changeAttributeValues = (e, id) => {
                let SelectBox = $(`select[name='attributes[${id}][value]']`);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content,
                        'Content-Type': 'application/json'
                    }
                });


                $.ajax({
                    type: 'POST',
                    url: '/admin/attributes/values',
                    data: JSON.stringify({
                        name: e.target.value,
                    })
                    ,
                    success: function (res) {
                        SelectBox.html(`
                          <option value="">انتخاب کنید</option>
                            ${
                            res.data.map(function (item) {
                               return `<option value="${item}">${item}</option>`
                            })}


                        `)
                    }
                })

            };


            let createNewAttr = ({attributes, id}) => {
                return `
                    <div class="row" id="attribute-${id}">
                        <div class="col-5">
                            <div class="form-group">
                                 <label>عنوان ویژگی</label>
                                 <select name="attributes[${id}][name]" onchange="changeAttributeValues(event, ${id});" class="attribute-select form-control">
                                    <option value="">انتخاب کنید</option>
                                    ${
                    attributes.map(function (item) {
                        return `<option value="${item}">${item}</option>`
                    })
                    }
                                 </select>
                            </div>
                        </div>
                        <div class="col-5">
                            <div class="form-group">
                                 <label>مقدار ویژگی</label>
                                 <select name="attributes[${id}][value]" class="attribute-select form-control">
                                                           <option value="">انتخاب کنید</option>
                                 </select>
                            </div>
                        </div>
                         <div class="col-2">
                            <label >اقدامات</label>
                            <div>
                                <button type="button" class="btn btn-sm btn-warning" onclick="document.getElementById('attribute-${id}').remove()">حذف</button>
                            </div>
                        </div>
                    </div>
                `
            }
            $('#add_product_attribute').click(function () {
                let attributesSection = $('#attribute_section');
                let id = attributesSection.children().length;

                let attributes = $('#attributes').data('attributes');

                attributesSection.append(
                    createNewAttr({
                        attributes,
                        id
                    })
                );

                $('.attribute-select').select2({tags: true});
            });
            $('.attribute-select').select2({tags: true});
        </script>
    @endslot
    @slot('breadcrumbs')
        <ol class="breadcrumb float-sm-left">
            {{ Breadcrumbs::render('admin.products.create') }}
        </ol>
    @endslot
    <div class="card">

        <!-- /.card-header -->

        <!-- form start -->
        <div id="attributes" data-attributes="{{ json_encode(\App\Models\Attribute::all()->pluck('name')) }}">

        </div>
        <form class="form-horizontal" method="post" action="{{ route('admin.products.store') }}">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">نام محصول</label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                           id="inputEmail3" placeholder="نام محصول را وارد کنید" value="{{ old('title') }}">
                    <div class="mt-2">
                        @error('title')
                        <span class="alert text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">توضیحات</label>
                    <textarea type="text" rows="5" name="description"
                              class="form-control @error('description') is-invalid @enderror"
                              id="inputEmail3">{{ old('description') }}</textarea>
                    <div class="mt-2">
                        @error('name')
                        <span class="alert text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">تعداد موجودی</label>
                    <input type="number" name="inventory" class="form-control @error('inventory') is-invalid @enderror"
                           id="inputEmail3" placeholder="تعداد موجودی محصول را وارد کنید"
                           value="{{ old('inventory') }}">
                    <div class="mt-2">
                        @error('inventory')
                        <span class="alert text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label>دسته بندی ها</label>
                    <select name="category[]" multiple class="form-control" id='categories'>
                        @foreach(App\models\Category::all() as $cate)

                            <option value="{{$cate->id}}">{{ $cate->name  }}</option>

                        @endforeach
                    </select>
                    <div class="mt-2">
                        @error('category')
                        <span class="alert text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <h6>ویژگی محصول</h6>
                    <hr>
                    <div id="attribute_section">

                    </div>
                    <button class="btn btn-sm btn-danger" type="button" id="add_product_attribute">ویژگی جدید</button>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">قیمت</label>
                    <input type="number" name="price" class="form-control @error('price') is-invalid @enderror"
                           id="inputEmail3" placeholder="تعداد موجودی محصول را وارد کنید" value="{{ old('price') }}">
                    <div class="mt-2">
                        @error('price')
                        <span class="alert text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>


            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-info">ثبت محصول</button>
                <a href="{{ route('admin.products.index') }}" class="btn btn-default float-left">لغو</a>
            </div>

            <!-- /.card-footer -->
        </form>
    </div>

@endcomponent
