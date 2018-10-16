import requests

stundents = [
    4520192150,
    1273648,
    59201815209,
    60201919817,
    59201818714,
    1273743,
    60202220971,
    59201813810,
    60202021675,
    59201816673,
    59201811066,
    60202221293,
    1273651,
    1274610,
    60202221019,
    60202221022,
    60202221020
]
for num in stundents:
    r = requests.post("https://swipein-mikerada6.c9users.io/addSwipe.php",
                      data={'piID': 8218945314, 'piPassword': 'D2E5C815E2312784454BCD43BA326', 'studnetId': num})
    print(r.status_code, r.reason)
r = requests.post("https://swipein-mikerada6.c9users.io/addSwipe.php",
                  data={'piID': 8218945314, 'piPassword': 'D2E5C815E2312784454BCD43BA326', 'studnetId': 9201717442, 'timestamp' : '2018-10-15 9:27:58'})
r = requests.post("https://swipein-mikerada6.c9users.io/addSwipe.php",
                  data={'piID': 8218945314, 'piPassword': 'D2E5C815E2312784454BCD43BA326', 'studnetId': 9201717442, 'timestamp' : '2018-10-15 9:33:00'})
r = requests.post("https://swipein-mikerada6.c9users.io/addSwipe.php",
                  data={'piID': 8218945314, 'piPassword': 'D2E5C815E2312784454BCD43BA326', 'studnetId': 60202119129, 'timestamp' : '2018-10-15 9:52:00'})
print(r.status_code, r.reason)
