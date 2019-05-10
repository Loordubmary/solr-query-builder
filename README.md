# Solr Query Builder - Codeigniter

How to make solr query from scratch

# Index

- Setup Solarium in codeigniter
- Simple Select Query
- Simple Search Query
- Simple Facet Query
- Multiple Selection using Facet
- Set Page limit
- Select query with Between option
- Show Selective Fields

# Setup Solarium in codeigniter

Please refer [Solr-Multiconnection-Codeigniter](https://github.com/Loordubmary/solr-multiconnection-codeigniter#3-setup-solarium) to setup solarium in codeigniter from scratch.

# Simple Select Query

This query is used to list all values from the solr core. 

```
// Create select query
$query = $this->client->createSelect();

// Store result
$result = $this->client->select($query);
```

The `createSelect()` is to create a basic query structure in solarium. The basic query structure is as follows,

```
Solarium\QueryType\Select\Query\Query Object
(
    [options:protected] => Array
        (
            [handler] => select
            [resultclass] => Solarium\QueryType\Select\Result\Result
            [documentclass] => Solarium\QueryType\Select\Result\Document
            [query] => *:*
            [start] => 0
            [rows] => 10
            [fields] => *,score
            [omitheader] => 1
        )

    [tags:protected] => Array
        (
        )

    [fields:protected] => Array
        (
            [*] => 1
            [score] => 1
        )

    [sorts:protected] => Array
        (
        )

    [filterQueries:protected] => Array
        (
        )

    [helper:protected] => 
    [params:protected] => Array
        (
        )

    [components:protected] => Array
        (
        )

    [componentTypes:protected] => Array
        (
            [morelikethis] => Solarium\Component\MoreLikeThis
            [spellcheck] => Solarium\Component\Spellcheck
            [suggest] => Solarium\Component\Suggester
            [debug] => Solarium\Component\Debug
            [spatial] => Solarium\Component\Spatial
            [facetset] => Solarium\Component\FacetSet
            [dismax] => Solarium\Component\DisMax
            [edismax] => Solarium\Component\EdisMax
            [highlighting] => Solarium\Component\Highlighting\Highlighting
            [grouping] => Solarium\Component\Grouping
            [distributedsearch] => Solarium\Component\DistributedSearch
            [stats] => Solarium\Component\Stats\Stats
            [queryelevation] => Solarium\Component\QueryElevation
            [rerankquery] => Solarium\Component\ReRankQuery
        )

)
```

And the `select()` is to process the query and store the result values.

If you want the code, Please download from [here](https://github.com/Loordubmary/solr-query-builder/blob/master/application/controllers/SimpleQuery.php).

# Simple Search Query

The `setQuery()` is used to perform search function.

The solarium Query format is below,

```$query->setQuery('field_name:"search_key"');```

`field_name` is refer to what type of thing we found. For example price, id or some other.

`search_key` is refer what thing we find that field.

The solarium search is first to verify the field is available or not. If the field is available it move to find the matches. If the field is not available it's throw error message.

If you want the code, Please download from [here](https://github.com/Loordubmary/solr-query-builder/blob/master/application/controllers/SimpleSearch.php).

# Simple Facet Query

The `getFacetSet()` is used to multi-purpose function in solarium. It is used to both search and filter functionality.

The solarium Query format is below,

``` 
// Initialise facet
$facetSet = $query->getFacetSet();

// Get Facet values depends on field
$facetSet->createFacetField('field_name_shortly')->setField('field_name');
```

`field_name` is a field name. 

`field_name_shortly` is a Facet name. It is help to retrieve the facet result using this name.

``` $facet = $result->getFacetSet()->getFacet('field_name_shortly'); ```

It is return output as unique value with total count.

For example, If you have this below recards in your core.

```
 -----------------------------
| price: 2.5                  |
| id: "id1"                   |
 -----------------------------
| price: 2.5                  |
| id: "id2"                   |
 -----------------------------
| price: 5.0                  |
| id: "id3"                   |
 -----------------------------
| price: 2.5                  |
| id: "id4"                   |
 -----------------------------                               
```

If the output of the above table depends on `price` field is below,

```
 ------------------------
| price       |  Count   |
 ------------------------
| 2.5         |  3       |
 ------------------------
| 5.0         |  1       |
 ------------------------
```

If you want the code, Please download from [here](https://github.com/Loordubmary/solr-query-builder/blob/master/application/controllers/SimpleFacet.php).

# Multiple Search using Facet

In facet we use `createFilterQuery()` to implement multiple search.

The code structure is here,

```
// Multiple select using Facet
$query->createFilterQuery('price')->addTag('price')->setQuery('price:"2.5" OR price:"1.5"');

// get the facetset component
$facetSet = $query->getFacetSet();

$facetField = $facetSet->createFacetField('multiple_select');
```

The `createFilterQuery()` is used to filter the whole table/core depends on the condition like `price:"2.5" OR price:"1.5"`.

And the `createFacetField()` is store the facet values with count including the createFilterQuery.

If you want the code, Please download from [here](https://github.com/Loordubmary/solr-query-builder/blob/master/application/controllers/MultipleSearch.php).


# Set Page limit

In solarium search only show 10 records for every search. Because this is the default mode for the solr.

So if you want more than 10 records in your result use `setRows()` in solarium.

The code structure is here,

``` 
$query->setStart('start')->setRows('no-of-rows');
```

The `setStart()` is the starting position of the result. It set '0' as default. If you set value as '5'. The result record is listed from 5th row.

The `setRows()` is used to how many records we want. It set '10' as default. If you set value as '50'. It shows 50 records from `setStart()` row.

If you want the code, Please download from [here](https://github.com/Loordubmary/solr-query-builder/blob/master/application/controllers/PageLimit.php).

# Select query with Between/Range option

The `between` is used to get value depends on some range. 

For example, we need products details based on some range using this option.

This code format is below,

``` $query->setQuery('price:[ 0.50 TO 3 ]'); ```

In the above line `[ 0.50 TO 2 ]` is refer to list the record only the price range `between 0.50 to 3`.

If you want the code, Please download from [here](https://github.com/Loordubmary/solr-query-builder/blob/master/application/controllers/BetweenOption.php).

# Show Selective fields

The solarium is list all field values as default. 

If you want some specific fields only to listing the output use `setFields()`.

The code structure is below,

```
$query->setFields(array('id','price'));
```

The array is used to mention what are the fields we want.

If you want the code, Please download from [here](https://github.com/Loordubmary/solr-query-builder/blob/master/application/controllers/SetFields.php).