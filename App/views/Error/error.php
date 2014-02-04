<div class="well">
    <div class="row">
        <div class="span2">Error: </div>
        <div class="span4"><?=$viewData["error"]?></div>
    </div>
    <div class="row">
        <div class="span2">Code: </div>
        <div class="span4"><?=$viewData["code"]?></div>
    </div>
    <div class="row">
        <div class="span2">Request Method: </div>
        <div class="span4"><?=$viewData["requestmethod"]?></div>
    </div>
    <div class="row">
        <div class="span2">Request URL: </div>
        <div class="span4"><?=$viewData["requesturl"]?></div>
    </div>
    <div class="row">
        <div class="span2">UserAgent: </div>
        <div class="span4"><?=$viewData["useragent"]?></div>
    </div>
    <div class="row">
        <div class="span2">UserIP: </div>
        <div class="span4"><?=$viewData["userip"]?></div>
    </div>
    <br />
    <table class="table table-bordered" style="background-color: #ffffff">
        <?  foreach( json_decode($viewData["trace"]) as $Trace) : ?>
        <tr>
            <td>
                <b>Line <?=(isset($Trace->line)) ? $Trace->line : "Undefined" ; ?> :</b>
                <?=(isset($Trace->file)) ? $Trace->file : "Undefined" ; ?>
            </td>
            <td><?=(isset($Trace->function)) ? $Trace->function : "Undefined" ; ?></td>
            <td><?=(isset($Trace->class)) ? $Trace->class : "Undefined" ; ?></td>
            <td><?=(isset($Trace->object)) ? print_r($Trace->object) : "Undefined" ; ?></td>
        </tr>
        <?  endforeach; ?>
    </table>
</div>