<li class="list-group-item row" id="row<?=$rowId?>">
    <input class="col-sm-3 col-12" type="text" name="row<?=$rowId?>name" id="row<?=$rowId?>name" value="<?=$dayName?>">
    <input class="col-sm-1 col-12" type="time" name="row<?=$rowId?>startTime" id="row<?=$rowId?>startTime" value="<?=$openTime?>">
    <input class="col-sm-1 col-12" type="time" name="row<?=$rowId?>stopTime" id="row<?=$rowId?>stopTime" value="<?=$closeTime?>">
    <input class="col-sm-2 col-12" type="date" name="row<?=$rowId?>date" id="row<?=$rowId?>date" value="<?=$date?>">
    <input class="col-sm-2 col-12" type="date" name="row<?=$rowId?>showdate" id="row<?=$rowId?>showdate" value="<?=$viewStartDate?>">
    <input class="col-sm-2 col-12" type="date" name="row<?=$rowId?>noshowdate" id="row<?=$rowId?>noshowdate" value="<?=$viewStopDate?>">
    <button class="col-sm-1 col-12 btn btn-danger" onClick="removeRow(<?=$rowId?>);" type="button" id="row<?=$rowId?>remove">Ta bort</button>
</li>