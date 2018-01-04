import random

# fibonacci is a function that takes in an integer k and returns the first k
# numbers in the fibonacci sequence
def fibonacci(k):
    if (k < 1):
        return ""
    elif (k == 1):
        return "0"
    elif (k == 2):
        return "0, 1"
    else:
        num1 = 0
        num2 = 1
        count = 3
        sum = num1 + num2
        list = str(num1) + ", " + str(num2) + ", " + str(sum)
        while (count < k):
            num1 = num2
            num2 = sum
            sum = num1 + num2
            list = list + ", " + str(sum)
            count = count + 1
        return list

# pascal is a function that takes in an integer k and returns the k-th row
# in the pascal triangle
def pascal(k):
    if (k < 1):
        return ""
    elif (k == 1):
        return "1"
    elif (k == 2):
        return "1 1"
    else:
        countArrays = 3
        total = []
        countNum = 0
        countArray = 0
        array = []
        while (countNum < k):
            array.append(1)
            countNum = countNum + 1
        total.append(array)
        countArray = countArray + 1
        while (countArray <= k / 2):
            countNum = 0
            array = []
            num = 1
            while (countNum < k - countArray):
                array.append(num)
                num = num + total[countArray - 1][countNum + 1]
                countNum = countNum + 1
            total.append(array)
            countArray = countArray + 1
        list = ""
        totalCount = 0
        arrayCount = k - 1
        while (totalCount < (k / 2) + 1):
            list = list + str(total[totalCount][arrayCount]) + " "
            totalCount = totalCount + 1
            arrayCount = arrayCount - 1
        if (k % 2 == 1):
            totalCount = (k / 2) - 1
        else:
            totalCount = (k / 2) - 2
        arrayCount = k - 1 - totalCount
        while (totalCount > -1):
            list = list + str(total[totalCount][arrayCount]) + " "
            totalCount = totalCount - 1
            arrayCount = arrayCount + 1
        return list

# pigLatin is a function that takes a string string and returns the string
# translated in pig latin
def pigLatin(string):
    words = string.split()
    wordArray = []
    for word in words:
        translated = str(word[1:]) + str(word[0]) + "ay"
        wordArray.append(translated)
    translatedPhrase = ""
    for word in wordArray:
        translatedPhrase = translatedPhrase + str(word) + " "
    return translatedPhrase

# wordFrame is a function that takes in a list of strings stringList and
# returns each string with a border of asterisks (*) around it
def wordFrame(stringList):
    k = len(stringList)
    longest = 0
    for word in stringList:
        if (len(word) > longest):
            longest = len(word)
    frameLength = longest + 4
    print ("*" * frameLength)
    for word in stringList:
        print ("* " + word + (" " * (frameLength - len(word) - 3)) + "*")
    print ("*" * frameLength)

# digitList is a function that takes in a number k and returns all the digits
# in k as an array
def digitList(k):
    list = []
    number = str(k)
    for digit in number:
        list.append(int(digit))
    return list

# rotateList is a function that takes in a list list and a number k and
# returns the list rotated by k elements
def rotateList(list, k):
    rotated = []
    index = k
    size = len(list)
    while (index < size):
        rotated.append(list[index])
        index = index + 1
    index = 0
    while (index < k):
        rotated.append(list[index])
        index = index + 1
    return rotated

# mergeLists is a recursive function that takes in two sorted lists list1 and
# list2 and an initially empty list merged and returns a single sorted list
# merged
def mergeLists(list1, list2, merged):
    size1 = len(list1)
    size2 = len(list2)
    sizeMerged = len(merged)
    if (size1 == 0 and size2 == 0):
        return merged
    elif (size1 == 0):
        for num in list2:
            merged.append(num)
        return merged
    elif (size2 == 0):
        for num in list1:
            merged.append(num)
        return merged
    else:
        if (list1[0] < list2[0]):
            merged.append(list1[0])
            list1 = list1[1:]
        elif (list2[0] < list1[0]):
            merged.append(list2[0])
            list2 = list2[1:]
        else:
            merged.append(list1[0])
            merged.append(list2[0])
            list1 = list1[1:]
            list2 = list2[1:]
        return mergeLists(list1, list2, merged)

# onAll is a higher-order function that takes in an array array and a
# function function and applies the function on every element in the array
def onAll(array, function):
    applied = []
    for num in array:
        applied.append(function(num))
    return applied

# isPalindrome is a function that takes in a string input and returns true
# if input is a palindrome and false otherwise
def isPalindrome(input):
    first = 0
    last = len(input) - 1
    while (first < last):
        if (input[first] != input[last]):
            return "false"
        first = first + 1
        last = last - 1
    return "true"

# guessPassword is a function that takes in a string password and returns a
# counter showing the number of guesses it took for a correct password
def guessPassword(password):
    characters = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', '1', '2', '3', '4', '5', '6', '7', '8', '9', '0', '!', '@', '#', '$', '%', '^', '&', '*', '(', ')']
    counter = 0
    string = ""
    for char in characters:
        string = string + char
        for char in characters:
            string = string + char
            for char in characters:
                string = string + char
                for char in characters:
                    string = string + char
                    counter = counter + 1
                    print (str(string))
                    if (string == password):
                        return counter
                    string = string[:3]
                string = string[:2]
            string = string[:1]
        string = ""

# numMoves is a function that takes in a number dimension, a list queenPos that
# contains two elements for the queen's x- and y-position (respectively), and
# a list bad that contains a list of (x, y)-pairs that are invalid for the queen
# to travel to
def numMoves(dim, queenPos, bad):
    numBad = len(bad)
    queenXpos = queenPos[0]
    queenYpos = queenPos[1]
    possible = []
    weights = []
    # west
    xTemp = queenXpos
    yTemp = queenYpos
    count = 0
    while (xTemp > 1):
        xTemp = xTemp - 1
        possible.append([xTemp, yTemp])
        count = count + 1
    countW = count
    while (count > 0):
        weights.append(count)
        count = count - 1
    # east
    xTemp = queenXpos
    yTemp = queenYpos
    count = 0
    while (xTemp < dim):
        xTemp = xTemp + 1
        possible.append([xTemp, yTemp])
        count = count + 1
    countE = count
    while (count > 0):
        weights.append(count)
        count = count - 1
    # south
    xTemp = queenXpos
    yTemp = queenYpos
    count = 0
    while (yTemp > 1):
        yTemp = yTemp - 1
        possible.append([xTemp, yTemp])
        count = count + 1
    countS = count
    while (count > 0):
        weights.append(count)
        count = count - 1
    # north
    xTemp = queenXpos
    yTemp = queenYpos
    count = 0
    while (yTemp < dim):
        yTemp = yTemp + 1
        possible.append([xTemp, yTemp])
        count = count + 1
    countN = count
    while (count > 0):
        weights.append(count)
        count = count - 1
    # southwest
    xTemp = queenXpos
    yTemp = queenYpos
    count = 0
    while (xTemp > 1 and yTemp > 1):
        xTemp = xTemp - 1
        yTemp = yTemp - 1
        possible.append([xTemp, yTemp])
        count = count + 1
    countSW = count
    while (count > 0):
        weights.append(count)
        count = count - 1
    # northeast
    xTemp = queenXpos
    yTemp = queenYpos
    count = 0
    while (xTemp < dim and yTemp < dim):
        xTemp = xTemp + 1
        yTemp = yTemp + 1
        possible.append([xTemp, yTemp])
        count = count + 1
    countNE = count
    while (count > 0):
        weights.append(count)
        count = count - 1
    # northwest
    xTemp = queenXpos
    yTemp = queenYpos
    count = 0
    while (xTemp > 1 and yTemp < dim):
        xTemp = xTemp - 1
        yTemp = yTemp + 1
        possible.append([xTemp, yTemp])
        count = count + 1
    countNW = count
    while (count > 0):
        weights.append(count)
        count = count - 1
    # southeast
    xTemp = queenXpos
    yTemp = queenYpos
    count = 0
    while (xTemp < dim and yTemp > 1):
        xTemp = xTemp + 1
        yTemp = yTemp - 1
        possible.append([xTemp, yTemp])
        count = count + 1
    countSE = count
    while (count > 0):
        weights.append(count)
        count = count - 1
    totalCount = countW + countE + countS + countN + countSW + countNE + countNW + countSE
    possibleSize = len(possible)
    arrayPos = 0
    for question in possible:
        if (question in bad):
            possibleSize = possibleSize - weights[arrayPos]
            remove = arrayPos
            while (weights[remove] != 1):
                if (possible[remove] in bad):
                    bad.remove(possible[remove])
                    possible.remove(possible[remove])
                    weights.pop(remove)
                else:
                    remove = remove + 1
        arrayPos = arrayPos + 1
    return possibleSize

# numMovesOptimized is a function that takes in a number dimension, a list
# queenPos that contains two elements for the queen's x- and y-position
# (respectively), and a list bad that contains a list of (x, y)-pairs that are
# invalid for the queen to travel to
def numMovesOptimized(dim, queenPos, bad):
    num = 0
    grid = [[0 for x in range(dim)] for y in range(dim)]
    for point in bad:
        x = point[0]
        y = point[1]
        grid[x - 1][y - 1] = 1
    xQueen = queenPos[0]
    yQueen = queenPos[1]
    counter = 0
    # west
    xTemp = xQueen
    yTemp = yQueen
    xTemp = xTemp - 1
    while (xTemp > 0 and grid[xTemp - 1][yTemp - 1] == 0):
        counter = counter + 1
        xTemp = xTemp - 1
    # east
    xTemp = xQueen
    yTemp = yQueen
    xTemp = xTemp + 1
    while (xTemp <= dim and grid[xTemp - 1][yTemp - 1] == 0):
        counter = counter + 1
        xTemp = xTemp + 1
    # south
    xTemp = xQueen
    yTemp = yQueen
    yTemp = yTemp - 1
    while (yTemp > 0 and grid[xTemp - 1][yTemp - 1] == 0):
        counter = counter + 1
        yTemp = yTemp - 1
    # north
    xTemp = xQueen
    yTemp = yQueen
    yTemp = yTemp + 1
    while (yTemp <= dim and grid[xTemp - 1][yTemp - 1] == 0):
        counter = counter + 1
        yTemp = yTemp + 1
    # southwest
    xTemp = xQueen
    yTemp = yQueen
    xTemp = xTemp - 1
    yTemp = yTemp - 1
    while (xTemp > 0 and yTemp > 0 and grid[xTemp - 1][yTemp - 1] == 0):
        counter = counter + 1
        xTemp = xTemp - 1
        yTemp = yTemp - 1
    # northeast
    xTemp = xQueen
    yTemp = yQueen
    xTemp = xTemp + 1
    yTemp = yTemp + 1
    while (xTemp <= dim and yTemp <= dim and grid[xTemp - 1][yTemp - 1] == 0):
        counter = counter + 1
        xTemp = xTemp + 1
        yTemp = yTemp + 1
    # northwest
    xTemp = xQueen
    yTemp = yQueen
    xTemp = xTemp - 1
    yTemp = yTemp + 1
    while (xTemp > 0 and yTemp <= dim and grid[xTemp - 1][yTemp - 1] == 0):
        counter = counter + 1
        xTemp = xTemp - 1
        yTemp = yTemp + 1
    # southeast
    xTemp = xQueen
    yTemp = yQueen
    xTemp = xTemp + 1
    yTemp = yTemp - 1
    while (xTemp <= dim and yTemp > 0 and grid[xTemp - 1][yTemp - 1] == 0):
        counter = counter + 1
        xTemp = xTemp + 1
        yTemp = yTemp - 1
    return counter

# rand5 is a function that generates a random number from 1 to 5
def rand5():
    return random.randint(1, 5)

# rand7 is a function that generates a random number from 1 to 7 using the rand5
# function
def rand7():
    sum = rand5() + rand5() + rand5() + rand5() + rand5() + rand5() + rand5()
    return (sum % 7) + 1

# randProb is a function that shows that rand5 and rand7 are truly random
def randProb():
    r5count1 = 0
    r5count2 = 0
    r5count3 = 0
    r5count4 = 0
    r5count5 = 0
    r7count1 = 0
    r7count2 = 0
    r7count3 = 0
    r7count4 = 0
    r7count5 = 0
    r7count6 = 0
    r7count7 = 0
    count = 0
    while (count < 1000000):
        num = rand5()
        if (num == 1):
            r5count1 += 1
        elif (num == 2):
            r5count2 += 1
        elif (num == 3):
            r5count3 += 1
        elif (num == 4):
            r5count4 += 1
        elif (num == 5):
            r5count5 += 1
        count += 1
    count = 0
    while (count < 1000000):
        num = rand7()
        if (num == 1):
            r7count1 += 1
        elif (num == 2):
            r7count2 += 1
        elif (num == 3):
            r7count3 += 1
        elif (num == 4):
            r7count4 += 1
        elif (num == 5):
            r7count5 += 1
        elif (num == 6):
            r7count6 += 1
        elif (num == 7):
            r7count7 += 1
        count += 1
    print (str(r5count1*100/200000))
    print (str(r5count2*100/200000))
    print (str(r5count3*100/200000))
    print (str(r5count4*100/200000))
    print (str(r5count5*100/200000))
    print (str(r7count1*100/142857))
    print (str(r7count2*100/142857))
    print (str(r7count3*100/142857))
    print (str(r7count4*100/142857))
    print (str(r7count5*100/142857))
    print (str(r7count6*100/142857))
    print (str(r7count7*100/142857))
