<thead>
    <tr>
        <th>项目名称</th>
        <th>中标单位</th>
        <th>中标金额</th>
        <th>中标时间</th>
        <th>操作</th>
    </tr>
</thead>
@foreach ($bid_articles as $bid_article)
<tr>
    <td>{{ $bid_article->name }}</td>
    <td>{{ $bid_article->company }}</td>
    <td>{{ $bid_article->price }}</td>
    <td>{{ $bid_article->date }}</td>
    <td>
        <a class="btn btn-default" target="_blank" href="{{ $bid_article->url }}">查看详情</a>
    </td>
</tr>
@endforeach
<tfoot>
    <tr>
        <th>项目名称</th>
        <th>中标单位</th>
        <th>中标金额</th>
        <th>中标时间</th>
        <th>操作</th>
    </tr>
</tfoot>