<?php
$key = "Grouping";
$pageTitle = "ag-Grid Grouping and Aggregation";
$pageDescription = "ag-Grid Grouping and Aggregation";
$pageKeyboards = "ag-Grid Grouping and Aggregation";
$pageGroup = "feature";
include '../documentation-main/documentation_header.php';
?>

<div>

    <h2><img src="../images/enterprise_50.png" title="Enterprise Feature"/> Grouping Rows</h2>

    <p>
        <br>
        This page shows how to group your rows. It starts off with Auto Column Groups, the simplest way to configure row
        groups and then builds up into more advanced topics for row grouping.
    </p>

    <h3>Auto Column Group</h3>
    <p>
        To group rows by a particular column, mark the column you want to group with <code>rowGroup=true</code>.
        There is no limit on the number of columns that the grid can group by.
        For example, the following will group the rows in the grid by country and then sport:
        <pre>gridOptions.columnDefs = [
    {headerName: "Country", field: "country", <span class="codeHighlight">rowGroup: true</span>},
    {headerName: "Sport", field: "sport", <span class="codeHighlight">rowGroup: true</span>},
];</pre>
    </p>


    <p>
        As you can see in the example below, as soon as there is at least on active row group, the grid will provide an
        additional column for displaying the groups in a tree structure, with expand/collapse navigation.
    </p>

    <ul>
        <li>There is a group column at the left that lets you open/close the groups. It also shows the amount
        of rows grouped in brackets.</li>
        <li>Sorting works out of the box in the group column. You can test this by clicking on the group column header.</li>
        <li>The country and sport columns used for grouping are still shown as normal. You can hide them
        by adding <code>hide: true</code> to their <i>colDef</i> as illustrated in the Multi Auto Column example.</li>
    </ul>

    <show-example example="exampleSimpleRowGroup"></show-example>

    <h3>Multi Auto Column Group</h3>
    <p>
        The grid also lets you automatically create one column for each individual group.
        This is achieved by setting <code>gridOptions.groupMultiAutoColumn = true</code>.
        The following example illustrates this. Note that:
    </p>

    <ul>
        <li>There is a group column displayed for each column that we are grouping by (in this case the country and
            year columns).</li>
        <li>Sorting works out of the box in each of these group column. You can test this by clicking on the group column header.</li>
        <li>The country and sport columns used for grouping are hidden so that we don't show redundant information.
            This is done by setting <code>colDef.hide = true</code>.</li>
    </ul>

    <show-example example="exampleSimpleRowMultiGroup"></show-example>

    <h3>Configuring the Auto Group Columns</h3>

    <p>
        You can specify your own configuration used by the auto group columns by providing a <code>gridOptions.groupColumnDef</code>.
        This can be used to override any property as defined in the <a href="../javascript-grid-column-definitions/">Columns</a>
        documentation page
    </p>

    <p>
        The auto columns generated by the grid use the ag-Grid provided group cell renderer.
        This means that
        <code>gridOptions.groupColumnDef</code> can also be used to pass additional properties to further customise how
        your groups are displayed.
    </p>
    <p>
        Check the <a href="../javascript-grid-cell-rendering-components/">cell rendering docs</a> to see all the available
        parameters available to configure the group cell renderer.
    </p>

    <p>
        The following example illustrates how you can configure the auto group columns. Note that:
    </p>

    <ul>
        <li>
            For the purpose of simplification this example uses one Auto Row Group Column. If you were to use Multi
            Auto Group Column the configuration would be applied to all the generated columns
        </li>
        <li>
            The header name of the group column is changed by setting in <code>groupColumnDef.headerName = 'CUSTOM!'</code>
        </li>
        <li>
            The count for each group is removed by setting <code>groupColumnDef.cellRendererParams.suppressCount = true</code>
        </li>
        <li>
            Each group has a select box by setting <code>groupColumnDef.cellRendererParams.checkbox = true</code>
        </li>
        <li>
            The group column has a custom comparator that changes the way sorting works, this is achieved by setting
            <code>groupColumnDef.cellRendererParams.comparator = function (left, right){...}</code>.

            The custom comparator provided in the example changes the way the sorting works by ignoring the first letter
            of the group. To test this click on the header. When sorting desc you should see countries which second letter
            goes from Z..A, asc should show countries which second letter goes A..Z
        </li>
    </ul>


    <show-example example="exampleGroupColumnDef"></show-example>

    <h3>Adding Values To Leaf Nodes</h3>

    <p>
        You may have noticed in the examples so far that the group columns don't produce values on the leaf nodes, the cells
        are empty. If you want to add values you can add a <a href="../javascript-grid-value-getters">valueGetter</a>
        or a field to the colDef and it will be used to render the leaf node.
    </p>

    <p>
        A good side effect of this is that then you can turn on filtering on the group column which has values for the leaf
        node and then the filtering will be available based on these values.
    </p>

    <p>
        This is illustrated in the following example. Note the following:
    </p>

    <ul>
        <li>We are suppressing auto group columns <code>groupSuppressAutoColumn = true</code> but the idea behind adding
        a value getter or a field reference to a group column would apply no matter which flavor of row grouping you
        are applying.</li>
        <li>To see the leaf node values, open any country and any year group column. Note how their leaf nodes have
        values for the columns 'Country' and 'Year - Group', the default is not to have values for this cells.</li>
        <li>Filtering is switched on so you can see how now you can filter the group column 'Country' and 'Year - Group'
            based on their leaf node values.</li>
        <li>Country is providing the value to the leaf nodes via specifying the field property, it is also reusing
            the same column that is grouping by as the column to display that group</code>
        </li>
        <li>Year is providing the value to the leaf nodes via a value getter, this way we get to show the value from a
            different column, the athlete column. In this case we are using two different columns 'Year - Group'
            shows the year group and 'year' which is hidden <code>hide:true</code> specifies that we want to group
            by this column.</li>
        <li>This is an example of a case where not using auto group columns lets us add custom behaviour to our
        grouping.</li>
    </ul>

    <show-example example="exampleValueGetters"></show-example>

    <h3>Group Cell Rendering</h3>

    <p>
        If you use the default group cell renderer provided by ag-grid, there are many parameters that can be passed
        to configure its behaviour, they are all explained in the
        <a href="../javascript-grid-cell-rendering-components">Group Cell Renderer</a> documentation. Please have a look
        at this docs if you are interested in finding our how to change the contents that are displayed in each grouped
        cell.
    </p>

    <p>
        You can also configure the look & feel of the expan/contract buttons by
        <a href="../javascript-grid-icons">specifying your own custom icons</a>
    </p>

    <h3>Specifying Row Group Order</h3>
    <p>
        By default, if you are using a column to display more than one group, the grid will order the groups based in
        the order in which you provide the columns. The following code snipped will group by country first, then sport
        second.
<pre>columnDefs = [
    <span class="codeComment">// country listed first, gets grouped first</span>
    {headerName: "Country", field: "country", <span class="codeHighlight">rowGroup: true</span>},
    <span class="codeComment">// sport listed second, gets grouped second</span>
    {headerName: "Sport", field: "sport", <span class="codeHighlight">rowGroup: true</span>},
];</pre>
    </p>

    <p>
        To explicitly set the order of the grouping and not depend on the column order, then use
        <code>rowGroupIndex</code> instead of <code>rowGroup</code> as follows:
    <pre>columnDefs = [
    <span class="codeComment">// index = 1, gets grouped second</span>
    {headerName: "Country", field: "country", <span class="codeHighlight">rowGroupIndex: 1</span>},
    <span class="codeComment">// index = 0, gets grouped first</span>
    {headerName: "Sport", field: "sport", <span class="codeHighlight">rowGroupIndex: 0</span>},
];</pre>
    </p>

    <p>
        The grid will order the sort the columns based on the <code>rowGroupIndex</code>. The values
        can be any numbers that are sortable, they do NOT need to start at zero (or one) and the sequence
        can have gaps.
    </p>

    <note>
        Using <code>rowGroup=true</code> is simpler and what most people will prefer using.
        You will notice that <code>rowGroupIndex</code> is used by the column API <i>getColumnState()</i>
        method as this cannot depend on the order of the column definitions.
    </note>

    <p>
        The following examples shows using <code>rowGroupIndex</code> to set the order of the group columns.
        Year is grouped first and Country is grouped second.
    </p>

    <show-example example="exampleRowGroupIndex"></show-example>


    <h3 id="replacingChildren">Hide Open Parents</h3>

    <p>
        Depending on your preference, you may wish to hide parent rows when they are open.
        This gives the impression to the user that the children takes the place of the
        parent row. This feature only makes sense when groups are in different columns.
        To turn this feature on set <code>groupHideOpenParents=true</code>.
    </p>

    <p>
        Below shows examples of this. Notice that each group row has
        <a href="../javascript-grid-aggregation/">aggregated values</a> which are explained in
        a documentation page of their own. When the group
        is closed, the group row shows the aggregated result. When the group is open,
        the group row is removed and in it's place the child rows are displayed.
        To allow closing the group again, the group column knows to display the parent
        group in the group column only (so you can click on the icon to close the group).
    </p>

    <h4>Example Hide Open Parents</h4>

    <p>
        The example below demonstrates hiding open parents using auto group columns.
        To help demonstrate, the grid is configured to shade the rows different colors
        for the different group levels, so when you open a group, you can see the background
        change indicating that the group row is no longer display, instead the children
        are in it's place.
    </p>

    <show-example example="exampleGroupingHideParentsAutoCol"></show-example>


    <h3 id="fullWidthRows">Full Width Group Rows</h3>

    <p>
        Instead of having a column for showing the groups, you can dedicate the full row for showing
        details about the group. This can be preferred if you have a lot of information you want to
        say about the group.
    </p>

    <p>
        The following example shows the first example in this page, the Auto Column Group example, using full width rows.
        Note that all that is necessary to achieve this it to add <code>groupUseEntireRow:true</code> to your gridOptions
    </p>

    <show-example example="exampleSimpleRowGroupFW"></show-example>


    <h3>Full Width Groups Rendering</h3>

    <p>
        It is possible to override the rendering of the group row using <i>groupRowRenderer</i> and
        <i>groupRowInnerRenderer</i>. Use groupRowRenderer to take full control of the row rendering,
        and provide a cellRenderer exactly how you would provide one for custom rendering of cells
        for non-groups.
    </p>
    <p>
        The following pieces of code do the exact same thing:
    <pre><code><span class="codeComment">// option 1 - tell the grid to group by row, the grid defaults to using</span>
<span class="codeComment">// the default group cell renderer for the row with default settings.</span>
gridOptions.groupUseEntireRow = true;

<span class="codeComment">// option 2 - this does the exact same as the above, except we configure</span>
<span class="codeComment">// it explicitly rather than letting the grid choose the defaults.</span>
<span class="codeComment">// we tell the grid what renderer to use (the built in renderer) and we</span>
<span class="codeComment">// configure the default renderer with our own inner renderer</span>
gridOptions.groupUseEntireRow = true;
gridOptions.groupRowRenderer:  'group';
gridOptions.groupRowRendererParams: {
    innerRenderer: function(params) {return params.node.key;},
};

<span class="codeComment">// option 3 - again the exact same. we allow the grid to choose the group</span>
<span class="codeComment">// cell renderer, but we provide our own inner renderer.</span>
gridOptions.groupUseEntireRow = true;
gridOptions.groupRowInnerRenderer: function(params) {return params.node.key;};
</code></pre>
    </p>
    <p>
        The above probably reads a bit confusing. So here are rules to help you choose:
    <ul>
        <li>
            If you are happy with what you get with just setting groupUseEntireRow = true,
            then stick with that, don't bother with the renderers.
        </li>
        <li>
            If you want to change the inside of the renderer, but are happy with the
            expand / collapse etc of the group row, then just set the groupRowInnerRenderer.
        </li>
        <li>
            If you want to customise the entire row, you are not happy with what you
            get for free with the group cell renderer, then set your own renderer
            with groupRowRenderer, or use groupRowRenderer to configure the default
            group renderer.
        </li>
    </ul>
    </p>
    <p>
        Here is an example of taking full control, creating your own renderer. In practice,
        this example is a bit useless, as you will need to add functionality to at least expand
        and collapse the group, however it demonstrates the configuration:
    <pre><code>gridOptions.groupUseEntireRow = true;
gridOptions.groupRowRenderer: function(params) {return params.node.key;};
</code></pre>
    <p>
        This example takes full control also, but uses the provided group renderer
        but configured differently by asking for a checkbox for selection:
    <pre><code>gridOptions.groupUseEntireRow = true;
gridOptions.groupRowRenderer: 'group';
gridOptions.groupRowRendererParams: {
    checkbox: true,
    // innerRenderer is optional, we could leave this out and use the default
    innerRenderer: function(params) {return params.node.key;},
}
</code></pre>
    </p>

    </p>
    <p>
        Below shows an example of aggregating,
        then using the entire row to give a summary.
    </p>

    <show-example example="exampleGroupRowRendering"></show-example>



    <h3>Full Width Group Rows - Embedding</h3>

    <p>
        You have two choices when using full width groups using the property <i>embedFullWidthRows</i> as follows:
    <ul>
        <li><b>embedFullWidthRows = false: </b> The group row will always
            span the width of the grid including pinned areas and is not impacted by horizontal scrolling.
            This is the most common usage and thus the default. The only drawback is that for some
            browsers (IE in particular), as you scroll vertically, the group row will lag behind the other rows.</li>
        <li><b>embedFullWidthRows = true: </b> The group row will be split into three sections for center,
            pinned left and pinned right. This is not ideal but works much faster with no IE issues.</li>
    </ul>
    So you might ask which one to use? The answer is the first one (just leave the property out, it's defaulted
    to false) unless you want to avoid IE performance issues.
    </p>

    <p>
        The example below demonstrates embedFullWidthRows on and off as follows:
    <ul>
        <li>Both grids have columns pinned left and right.</li>
        <li>Both grids have group rows spanning the grid width.</li>
        <li>The top grid as embedFullWidthRows=false, the bottom grid has embedFullWidthRows=true.</li>
    </ul>
    So with this setup, you will notice the following difference:
    <ul>
        <li>
            In the top grid, the group rows are not impacted by the pinning. In the bottom grid,
            the groups are truncated if you make the Athlete & Year columns to small,
            as the groups are sitting in the pinned section.
        </li>
        <li>
            In the bottom grid, if you unpin the columns (via the column menu) then the group jumps
            to the center.
        </li>
    </ul>
    </p>

    <show-example example="exampleFullWidthRowsComparison"></show-example>

    <p>
        If you are using custom group row rendering (explained below) and embedFullWidthRows = true, the panel
        you are rendering in is provided via the <i>pinned</i> parameter.
    </p>

    <h3>Grouping API</h3>

    <p>
        To expand or contract a group via the API, you fist must get a reference to the rowNode and then call
        <i>rowNode.setExpanded(boolean).</i> This will result in the grid getting updated and displaying the
        correct rows. For example, to expand a group with the name 'Zimbabwe' would be done as follows:
    <pre>gridOptions.api.forEachNode(function(node) {
    if (node.key==='Zimbabwe') {
        node.setExpanded(true);
    }
});</pre>
    </p>

    <p>
        Calling <i>node.setExpanded()</i> causes the grid to get redrawn. If you have many nodes you want to
        expand, then it is best to set node.expanded=true directly, and then call
        <i>api.onGroupExpandedOrCollapsed()</i> when finished to get the grid to redraw the grid again just once.
    </p>

    <h3>Grouping Complex Objects with Keys</h3>

    <p>
        If your rowData has complex objects that you want to group by, then the default grouping
        will convert each object to <i>"[object object]"</i> which will be useless to you. Instead
        you need to get the grid to convert each object into a meaningful string to act as the key
        for the group. You could add a 'toString' method to the objects - but this may not be possible
        if you are working with JSON data. To get around this, use <i>colDef.keyCreator</i>, which
        gets passed a value and should return the string key for that value.
    </p>

    <p>
        The example below shows grouping on the county, with country an object within each row.
    <pre>rowItem = {
    athlete: 'Michael Phelps',
        country: { <span class="codeComment">// country is complex object, so need to provide colDef.keyCreator()</span>
        name: 'United States',
        code: 'US'
    }
    ....
}</pre>


    <h3>Grouping Footers</h3>

    <p>
        If you want to include a footer with each group, set the property <i>groupIncludeFooter</i> to true.
        The footer is displayed as the last line of the group when then group is expanded - it is not displayed
        when the group is collapsed.
    </p>
    <p>
        The footer by default will display the word 'Total' followed by the group key. If this is not what you
        want, then use the <i>footerValueGetter</i> option. The following shows two snippets for achieving
        the same, one using a function, one using an expression.
    </p>
    <pre><code>// use a function to return a footer value
cellRenderer: 'group',
cellRendererParams: {
    footerValueGetter: function(params) { return 'Total (' + params.value + ')'},
}}

// use an expression to return a footer value. this gives the same result as above
cellRenderer: 'group',
cellRendererParams: {
    footerValueGetter: '"Total (" + x + ")"'
}}</code></pre>
    <p>
        When showing the groups in one column, the aggregation data is displayed
        in the group header when collapsed and only in the footer when expanded (ie it moves from the header
        to the footer). To have different rendering, provide a custom <i>groupInnerCellRenderer</i>, where
        the renderer can check if it's a header or footer.
    </p>

    <p>
        The example below uses <a href="../javascript-grid-aggregation/">aggregation</a> which is explained in
        the next section but included here as footer rows only make sense when used with aggregation.
    </p>

    <show-example example="groupingFooters"></show-example>

    </p>

    <h3>Keeping Group State</h3>

    <p>
        <note>This section only applies if you don't have <a href="../javascript-grid-data-update/#delta-row-data">delta
        updates</a> active in your grid. If you are using delta updates
        the state of the groups are kept automatically for you after every update.</note>
    </p>

    <p>
        When you set new data into the group by default all the group open/closed states are reset.
        If you want to keep the original state, then set the property <i>rememberGroupStateWhenNewData=true</i>.
        The example below demonstrates this. Only half the data is shown in the grid at any given time,
        either the odd rows or the even rows. Hitting the 'Refresh Data' will set the data to 'the other half'.
        Note that not all groups are present in both sets (eg 'Afghanistan' is only present in one group) and
        as such the state is not maintained. A group like 'Australia' is in both sets and is maintained.
    </p>

    <show-example example="exampleKeepingGroupState"></show-example>


    <h3 id="removeSingleChildren">Removing Single Children</h3>

    <p>
        If your data has groups with only one child, then it can make sense to collapse
        these groups as there is no benefit to the user creating groups with just one child,
        it's arguably waste of space.
    </p>

    <p>
        To turn this feature on, set the property <i>groupRemoveSingleChildren=true</i>.
    </p>

    <p>
        The example below shows this feature in action. To demonstrate why this feature is needed
        you can click 'Toggle Grid' to show what the grid would be like without this setting. You
        will see the group UK, German and Sweden have only one child so the group is not giving any extra
        value to the data.
    </p>

    <note>
        Filtering does not impact what groups get removed. For example if you have a group with two
        children, the group is not removed, even if you apply a filter that removes one of the children.
        This is because ag-Grid does grouping first and then applies filters second. If you change the filter,
        only the filter is reapplied, the grouping is not reapplied.
    </note>

    <show-example example="exampleRemoveSingleChildren"></show-example>

    <note>
        It is not possible to mix <i>groupRemoveSingleChildren</i> and <i>groupHideOpenParents</i>.
        Technically, it doesn't make sense. Mixing these two will put you down a black hole so deep not
        even Stephen Hawking will be able to save you.
    </note>

    <h3>Suppress Group Row</h3>

    <p>
        By suppressing the group row you don't give users the ability to close the groups by themselves,
        but the rows are grouped and the other functionalities take the grouping into account.
        Sorting, for example, will sort by group.
    </p>

    <show-example example="exampleSuppressGroupRow"></show-example>

    <h3>Creating Your Own Group Display Columns</h3>

    <p>
        In all the previous examples the grid is in charge of generating the column's that display the groups, these columns
        are called auto group columns.
    </p>

    <p>
        You can prevent the generation of the auto group columns and take control over which columns display which groups.
        This is useful if you want to have a finer control over how your groups are displayed.
    </p>

    <note>
        We advise against using your own group columns. Only do this if the Auto Group Columns do not meet
        your requirements. Otherwise defining your own group columns will add unnecessary complexity to your code.
    </note>

    <p>
        To disable the auto group columns set <code>gridOptions.groupSuppressAutoColumn = true</code>. When you do this,
        you will be in charge of configuring which columns show which groups.
    </p>

    <p>
        In order to make a column display a group, you need to configure the property <i>coldef.showRowGroup</i> for that
        column.
    </p>

    <p>
        <i>coldef.showRowGroup</i> can be configured in two different fashions.
    <ul>
        <li>To tell this column to show all the groups: <code>coldef.showRowGroup= true</code></li>
        <li>To tell this column to show the grouping for a particular column. If you want to do this you need to
            know the <i>colId</i> of the column that you want to show the group by and set <code>coldef.showRowGroup= colId</code></li>
    </ul>
    </p>

    <p>
        If you do specify <i>coldef.showRowGroup</i> you are going to also tell this column how to display the contents
        of this group, the easiest way to do this is by using the out of the box
        <a href="../javascript-grid-cell-rendering-components">group cell renderer</a> <code>cellRenderer: 'group'</code>
    </p>

    <p>
        This illustrates how to configure an specific column to show the groups generated by the country column
    <pre>
coldefs:[
    <span class="codeComment">// The column we are grouping by, it is also hidden.</span>
    {headerName: "Country", field: "country", width: 120, rowGroup:true, hide:true},
    <span class="codeComment">// We appoint this column as the column to show the country groups.</span>
    <span class="codeComment">// note that we need to provide an appropiate cell renderer.</span>
    <span class="codeComment">// in this case we are using the out of the box group cell renderer.</span>
    {headerName: "Country - group", showRowGroup='country', width: 120, cellRenderer: 'group'},
]
</pre>

    <p>The following example shows how to appoint individual columns to show individual groups</p>

    <show-example example="exampleGroupingManyGroupColumns"></show-example>

    <p>The following example shows how to display all the groups in a single column</p>

    <show-example example="exampleGroupingOneGroupColumns"></show-example>

    <p>
        The last example of explicitly setting groups shows an alternative for Hide Open Parents.
        The example below demonstrates hiding open parents using explicit group columns.
    </p>

    <show-example example="exampleGroupingHideParents"></show-example>

    <note>Remember these examples are achieving the same that you can achieve with
        the auto groups columns, but their configuration is not as straight forward. We are keeping this for edge cases
        and for backwards compatibility for when we only supported this style of configuration.</note>


    <h3>Grid Grouping Properties</h3>
    <p>
        Grouping has the following grid properties (set these as grid properties, e.g. on the gridOptions, not on the columns):
    </p>
    <table class="table">
        <tr>
            <th>Property</th>
            <th>Description</th>
        </tr>
        <tr>
            <th>groupUseEntireRow</th>
            <td>If grouping, set to true or false (default is false). If true, a group row will span all columns across the entire
                width of the table. If false, the cells will be rendered as normal and you will have the opportunity to include
                a grouping column (normally the first on the left) to show the group.</td>
        </tr>
        <tr>
            <th>groupDefaultExpanded</th>
            <td>If grouping, set to the number of levels to expand by default.
                Eg 0 for none, 1 first level only, etc. Default is 0 (expand none).
                Set to -1 for expand everything.
            </td>
        </tr>
        <tr>
            <th>groupIncludeFooter</th>
            <td>If grouping, whether to show a group footer when the group is expanded. If true, then by default, the footer
                will contain aggregate data (if any) when shown and the header will be black. When closed, the header will
                contain the aggregate data regardless of this setting (as footer is hidden anyway). This is handy for
                'total' rows, that are displayed below the data when the group is open, and alongside the group when
                it is closed.
            </td>
        </tr>
        <tr>
            <th>groupColumnDef</th>
            <td>Allows specifying the group 'auto column' if you are not happy with the default. If grouping, this column def is included as the first column definition in the grid. If not grouping,
                this column is not included.
            </td>
        </tr>
        <tr>
            <th>groupSuppressAutoColumn</th>
            <td>If true, the grid will not swap in the grouping column when grouping is enabled. Use this if you
                want complete control on the column displayed and don't want the grids help. In other words,
                you already have a column in your column definitions that is responsible for displaying the groups.
            </td>
        </tr>
        <tr>
            <th>groupMultiAutoColumn</th>
            <td>If using auto column, set to true to have each group in it's own column separate column, eg
                if group by Country then Year, two auto columns will be created, one for country and one for year.</td>
        </tr>
        <tr>
            <th>groupSuppressRow</th>
            <td>If true, the group row won't be displayed and the groups will be expanded by default
                with no ability to expand / contract the groups. Useful when you want to just 'group'
                the rows, but not add parent group row to each group.
            </td>
        </tr>
        <tr>
            <th>groupSuppressBlankHeader</th>
            <td>If true, and showing footer, aggregate data will be displayed at both the header and footer
                levels always. This stops the possibly undesirable behaviour of the header details 'jumping'
                to the footer on expand.
            </td>
        </tr>
        <tr>
            <th>groupSelectsChildren</th>
            <td>When true, if you select a group, the the children of the group will also get selected.</td>
        </tr>
        <tr>
            <th>groupSelectsFiltered</th>
            <td>If using groupSelectsChildren, then only the children that pass the current filter will get selected.</td>
        </tr>
        <tr>
            <th>groupRemoveSingleChildren</th>
            <td>Set to true to collapse groups that only have one child.</td>
        </tr>
        <tr>
            <th>groupHideOpenParents</th>
            <td>Set to true to hide parents that are open. When used with multiple columns for showing
                groups, it can give more pleasing user experience.</td>
        </tr>
        <tr>
            <th>animateRows</th>
            <td>
                Set to true to enable animation of the rows after group is opened and closed.
            </td>
        </tr>

    </table>

    <table class="table">
        <tr>
            <th>Callback</th>
            <th>Description</th>
        </tr>
        <tr>
            <th>groupRowRenderer, groupRowRendererParams</th>
            <td>If grouping, allows custom rendering of the group cell. Use this if you are not happy with the default
                presentation of the group. This is only used when groupUseEntireRow=true. This gives you full control
                of the row, so the grid will not provide any default expand / collapse or selection checkbox.
                See section on cellRendering for details on params.</td>
        </tr>
        <tr>
            <th>groupRowInnerRenderer</th>
            <td>Similar to groupRowRenderer, except the grid will provide a default shell for row which includes an
                expand / collapse function. The innerRenderer is responsible for just the inside part of the row.
                There is no <i>groupRowInnerRendererParams</i> as the <i>groupRowRendererParams</i> are reused
                for both</td>
        </tr>

    </table>

</div>

<?php include '../documentation-main/documentation_footer.php';?>
