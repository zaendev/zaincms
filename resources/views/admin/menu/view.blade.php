<div class="mb-2">
    <select class="form-control" name="dataMenu" id="dataMenu" required>
        <option value="">--Select Menu--</option>
        {!! $menu !!}
    </select>
</div>

<div class="showMenu" style="display: none">
    <hr>
    <div id="formMenu">
        <div class="show-error-msg" style="color:red; display:none">
            <ul></ul>
        </div>
        <div class="form-group">
            <input type="text" class="form-control" id="menu" placeholder="menu"
                   name="menu">
        </div>
        <div class="form-group">
            <select class="form-control" name="parentMenu" id="parentMenu">
                <option value="0">--Parent Menu--</option>
                {!!  $menu  !!}
            </select>
        </div>
    </div>
</div>