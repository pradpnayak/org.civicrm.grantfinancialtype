{if $action eq 4}
<table>
  <tr class="crm-grant-view-form-block-financial_type_id">
    <td class="label">{ts}Financial Type{/ts}</td>
    <td>
      {assign var=n value='financial_type_id.name'}
      {crmAPI var='result' entity='Grant' action='get' return="financial_type_id.name" id=$id}
      {foreach from=$result.values item=grant}
        {$grant.$n}
      {/foreach}
    </td>
  </tr>
</table>
{literal}
<script type="text/javascript">
  CRM.$(function($) {
    $($('tr.crm-grant-view-form-block-financial_type_id')).insertAfter('tr.crm-grant-view-form-block-grant_type_id');
  });
</script>
{/literal}
{/if}
