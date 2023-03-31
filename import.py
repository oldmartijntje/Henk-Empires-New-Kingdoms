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
    "name", "power", "energy", "balance", "onReveal", "onGoing", "special", "description", "type"
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

    ii+=1

print(convertToPHP(items))