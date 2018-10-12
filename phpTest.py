import requests
r = requests.post("https://swipein-mikerada6.c9users.io/addSwipe.php", data={'piID':8218945314, 'piPassword':'D2E5C815E2312784454BCD43BA326', 'studnetId':15})
print(r.status_code, r.reason)