var company = new Bloodhound({
    datumTokenizer: Bloodhound.tokenizers.whitespace,
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    remote: {
        wildcard: "%QUERY",
        url: path + "/search/results?query=%QUERY"
    }
});

company.initialize();

$("#typeahead").typeahead({
    highlight: true
}, {
    name: "company",
    display: "name",
    limit: 5,
    source: company
});

$("#typeahead").bind("typeahead:select", function (ev, suggestion) {
    window.location = path + "/search/?s=" + encodeURIComponent(suggestion.name);
});