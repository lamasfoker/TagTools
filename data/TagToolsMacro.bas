Attribute VB_Name = "TagToolsMacro"
Sub InserisciImmagineDescrizione()
    Dim oDialog As Word.Dialog
    Dim XDoc As Object, root As Object
    Dim FileName As String
    Dim docRef As Document
    
       Selection.ParagraphFormat.Alignment = wdAlignParagraphCenter
    
     '\\ Inserisci Immagine
    Set oDialog = Dialogs(wdDialogInsertPicture)
     
    With oDialog
        .Display
        
        If .Name <> "" Then
            ActiveDocument.InlineShapes.AddPicture FileName:=.Name, _
            LinkToFile:=False, _
            SaveWithDocument:=True, _
            Range:=Selection.Range
        End If
    End With
    
    Selection.MoveRight Unit:=wdCharacter, Count:=1
    Selection.TypeParagraph
    
    '\\Inserisci descrizione
    With Application.FileDialog(msoFileDialogFilePicker)
        .Title = "Select XML File To Use"
        .AllowMultiSelect = False
        .InitialFileName = ".xml"
        
        If .Show <> 0 Then
            FileName = .SelectedItems(1)
        Else
            MsgBox "No File Selected"
            Exit Sub
        End If
    End With
    Set XDoc = CreateObject("MSXML2.DOMDocument")
    XDoc.async = False: XDoc.validateOnParse = False
    XDoc.Load (FileName)
    Set Lists = XDoc.DocumentElement
    
    If Lists Is Nothing Then
        MsgBox "Selected file is not in the required format (XML)"
        Exit Sub
    End If
    
    Selection.TypeText Text:="Figura: "
    
    For Each listNode In Lists.ChildNodes
        For Each fieldNode In listNode.ChildNodes
            Selection.TypeText Text:=fieldNode.Text
            Selection.TypeText Text:=", "
        Next fieldNode
    Next listNode
    
    Selection.TypeBackspace
    Selection.TypeBackspace
    Selection.TypeParagraph
    Selection.ParagraphFormat.Alignment = wdAlignParagraphLeft
    
     '\\ Pulizia
    Set oDialog = Nothing
    Set XDoc = Nothing
    
End Sub
