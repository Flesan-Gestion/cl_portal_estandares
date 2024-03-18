<div style="width:100%;font-size:1.5rem;font-weight:bold;text-align:center;padding: .5rem;margin-bottom:1rem">
    Se ha registrado un nuevo comentario
</div>
<table cellspacing="0" cellpadding="0" align="center"
    style="border-collapse:collapse;border-spacing:0px;table-layout:fixed!important;width:100%">
    <thead>
        <tr style="border-collapse:collapse">
            <td style="padding:0;Margin:0">
                <h4
                    style="Margin:0;line-height:120%;font-family:'open sans','helvetica neue',helvetica,arial,sans-serif">
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">Estándar #</font>
                    </font>
                </h4>
            </td>
            <td style="padding:0;Margin:0">
                <h4
                    style="Margin:0;line-height:120%;font-family:'open sans','helvetica neue',helvetica,arial,sans-serif">
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">{{ $comment['standard']['st_code'] }}</font>
                    </font>
                </h4>
            </td>
        </tr>
    </thead>
    <tbody>

        <tr style="border-collapse:collapse;border-top: 3px solid #eeeeee; margin: 12px 0px">
        </tr>

        <tr style="border-collapse:collapse">
            <td style="padding:5px 10px 5px 0;Margin:0" align="left">
                <p
                    style="Margin:0;font-size:16px;font-family:'open sans','helvetica neue',helvetica,arial,sans-serif;line-height:24px;color:#333333">
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">Usuario:</font>
                    </font>
                </p>
            </td>
            <td style="padding:5px 0;Margin:0" align="left">
                <p
                    style="Margin:0;font-size:16px;font-family:'open sans','helvetica neue',helvetica,arial,sans-serif;line-height:24px;color:#333333">
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">{{ $comment['user_create'] }}</font>
                    </font>
                </p>
            </td>
        </tr>

        <tr style="border-collapse:collapse">
            <td style="padding:5px 10px 5px 0;Margin:0" align="left" colspan="2">
                <p
                    style="Margin:0;font-size:16px;font-family:'open sans','helvetica neue',helvetica,arial,sans-serif;line-height:24px;color:#333333">
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">Comentario:</font>
                    </font>
                </p>
            </td>
        </tr>

        <tr style="border-collapse:collapse">
            <td style="padding:5px 10px 5px 0;Margin:0" align="left" colspan="2">
                <p
                    style="Margin:0;font-size:16px;font-family:'open sans','helvetica neue',helvetica,arial,sans-serif;line-height:24px;color:#333333">
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">{{ $comment['cm_comment'] }}</font>
                    </font>
                </p>
            </td>

        </tr>


    </tbody>
</table>
