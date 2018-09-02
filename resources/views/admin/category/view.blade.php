<div class="form-group">
    <select class="form-control" name="dataCategory" id="dataCategory">
        <option value="">--Select Category--</option>
        {!! $category !!}
    </select>
</div>
<div class="showCat" style="display: none">
    <hr>
    <div id="formCategory">
        <div class="show-error-msg" style="color:red; display:none">
            <ul></ul>
        </div>
        <div class="form-group">
            <input type="text" class="form-control" id="category" placeholder="Category"
                   name="category">
        </div>
        <input type="hidden" value="post" id="module" name="module">
        <div class="form-group">
            <select class="form-control" name="parentCat" id="parentCat">
                <option value="0">--Parent Category--</option>
                {!! $category !!}
            </select>
        </div>
    </div>
</div>