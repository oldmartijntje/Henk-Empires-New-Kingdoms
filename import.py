def convertToPHP(dictionaryArray):
    textMessage = ''
    for dictionary in dictionaryArray:
        textMessage += '['
        for key in dictionary:
            if type(dictionary[key]) is str:
                textMessage += "\"" + key + "\"" + ' => ' + "\"" + dictionary[key] + "\"" + ', '
            else:
                textMessage += "\"" + key + "\"" + ' => ' + str(dictionary[key]) + ', '
        textMessage = textMessage[:-2]
        textMessage += '],\n'
    return textMessage

format = [
    "name", "power", "energy", "balance", "onReveal", "onGoing", "description", "special", "type", "series"
]
defaultNone = [
    "image"
]
items = []
ii=0
loop = True
while loop:
    items.append({})
    for i in range(len(format)):
        print(format[i], end = ": ")
        items[ii][format[i]] =input()
        if items[ii][format[i]] == 'exit':
            loop = False
            print(format[i], end = ": ")
            items[ii][format[i]] =input()
    for i in range(len(defaultNone)):
        items[ii][defaultNone[i]] = ''

    ii+=1

print(convertToPHP(items))