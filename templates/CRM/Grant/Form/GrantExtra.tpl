<table>
  {if $form.financial_type_id}
    <tr class="crm-grant-form-block-financial_type_id">
      <td class="label">{$form.financial_type_id.label}</td>
      <td>{$form.financial_type_id.html}</td>
    </tr>
  {elseif $action eq 1}
    <tr class="crm-grant-form-block-grant_financial_type_id">
      <td colspan="3">{$form.grant_financial_type_id.label}
      {$form.grant_financial_type_id.html}
      </td>
    </tr>
  {/if}
</table>
{if $form.financial_type_id}
  {literal}
  <script type="text/javascript">
    CRM.$(function($) {
      $($('tr.crm-grant-form-block-financial_type_id')).insertAfter('tr.crm-grant-form-block-grant_type_id');
    });
  </script>
  {/literal}
{elseif $action eq 1}
  {literal}
  <script type="text/javascript">
    CRM.$(function($) {
      var tdSection = $('.CRM_Grant_Form_Search table.form-layout tbody tr:first-child');
      $('.CRM_Grant_Form_Search table.form-layout tbody tr:first-child ').after($('tr.crm-grant-form-block-grant_financial_type_id'));
    });
  </script>
  {/literal}
{/if}

{if $rows}
<table style="display:none;">
  <tr>
    {foreach from=$rows item=row}
      <td id="grant_financial_type_{$row.grant_id}" class="crm-grant-grant_financial_type">{$row.grant_financial_type}</td>
    {/foreach}
  </tr>
</table>

{literal}
<script type="text/javascript">
  CRM.$(function($) {
    $('table.selector tbody tr').each(function() {
      var elementId = this.id;
      var grantId = elementId.replace('crm-grant_', '');
      $($('td#grant_financial_type_' + grantId)).insertAfter('tr#' + elementId + ' td.crm-grant-grant_type');
    });
  });
</script>
{/literal}
{/if}
