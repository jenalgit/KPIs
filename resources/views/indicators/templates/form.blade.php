<?php
/*
 * The MIT License
 *
 * Copyright 2017 Sotiris Karampatakis Open Knowledge Greece.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */
?>
<script>
    $(document).ready(function () {
        $('select').material_select();
    });

    function update(data) {
        var organization = $("#organization-select option:selected")[0].value;
        $.ajax({
            type: "GET",
            url: "phases",
            data: {organization: organization},
            success: function (data) {
                $("#phase").html(data);
                $('#phase > select').material_select();
            }
        });
        $.ajax({
            type: "GET",
            url: "years",
            data: {organization: organization},
            success: function (data) {
                $("#year").html(data);
                $('#year > select').material_select();
            }
        });
    }


</script>
<div class='form'>
    <div class="row">
        <div class="input-field col s3">
            <select id="organization-select" onchange="update(this)">     
                @foreach($organizations as $organization)
                <option value="{{$organization["value"]}}">{{$organization["label"]}}</option>
                @endforeach
            </select>
            <label>Organization</label>
        </div>
        <div id="phase" class="input-field col s3">
            <select>
            </select>
        </div>
        <div id="year" class="input-field col s3">
            <select>
            </select>
        </div>
        <div class="input-field col s3 valign-wrapper">
            <button onclick="indicators()" class="btn-floatin btn-large waves-effect waves-light" type="submit" name="action">Submit
                <i class="material-icons right">send</i>
            </button>
        </div>
    </div>
</div>
<script>
    function indicators() {
        var organization = $("#organization-select option:selected")[0].value;
        var year = $("#year-select option:selected")[0].value;
        var phase = $("#phase-select option:selected")[0].value;
        $.ajax({
            type: "GET",
            url: "dashboard",
            data: {organization: organization, year: year, phase: phase},
            success: function (data) {
                $(".dashboard").html(data);
            }
        });
    }
</script>