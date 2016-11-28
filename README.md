Rcm I18n translation library and utilities
==============================

#### Rcm Translate API ####

Rcm Translate API - HTTP API for translations 

Calling the API:

```
    https://example.com/api/rcm-translate-api/MY-TRANSLATION-NAMESPACE?1=term1&key2=term2
```
    
The query param field is an arbitrary key (usually the same as the term)
The query param value is the term (string) to translate

I.E.

?queryField=queryValue equates to: someValue=translationString

Result:

```
{
    "term1": "term1 translation",
    "term2": "term2 translation"
}
```

#### ToDo ####

- Complete the Zend Expressive part 
    - Need to register translator plugins with ZF2 application
