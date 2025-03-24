# 📌 Princípios SOLID Aplicados ao Projeto FastDev


---

## ✅ 1. Single Responsibility Principle (Princípio da Responsabilidade Única)

**Explicação:**
Cada classe deve ter uma única responsabilidade bem definida.

**Exemplo errado:**
```java
public class UserManager {
    public void createUser(User user) {}
    public void sendEmail(String message) {}
    public void processPayment(Payment payment) {}
}
```

**Exemplo correto:**
```java
public class UserService {
    public void createUser(User user) {}
}

public class EmailService {
    public void sendEmail(String message) {}
}

public class PaymentService {
    public void processPayment(Payment payment) {}
}
```

---

## ✅ 2. Open/Closed Principle (Princípio Aberto/Fechado)

**Explicação:**
Classes devem permitir extensão sem precisar alterar o código fonte original. Isso é feito usando interfaces ou classes abstratas, permitindo novas funcionalidades serem adicionadas facilmente sem modificar o código existente.

**Exemplo errado:**
```java
public class PaymentProcessor {
    public void pay(String type) {
        if (type.equals("PIX")) {}
        else if (type.equals("CARD")) {}
    }
}
// Ao adicionar um novo método de pagamento, será preciso modificar esta classe.
```

**Exemplo correto:**
```java
public interface Payment {
    void pay();
}

public class PixPayment implements Payment {
    public void pay() {}
}

public class CardPayment implements Payment {
    public void pay() {}
}

public class PaymentProcessor {
    public void process(Payment payment) {
        payment.pay();
    }
}
// Ao adicionar novos tipos de pagamentos, basta criar novas implementações da interface Payment, sem precisar alterar o PaymentProcessor.
```

---

## ✅ 3. Liskov Substitution Principle (Princípio da Substituição de Liskov)

**Explicação:**
Subclasses devem ser capazes de substituir as superclasses sem alterar o comportamento correto do sistema. Se uma classe derivada não pode implementar corretamente um método da classe base, então provavelmente não deveria herdar dela.

**Exemplo errado:**
```java
public class Video {
    void play() {}
}

public class PremiumVideo extends Video {
    @Override
    void play() { throw new UnsupportedOperationException("Não pode reproduzir."); }
}
// PremiumVideo não substitui corretamente Video, pois seu comportamento é incompatível.
```

**Exemplo correto:**
```java
public abstract class Video {
    abstract void play();
}

public class FreeVideo extends Video {
    @Override
    void play() { /* reprodução padrão sem restrições */ }
}

public class PremiumVideo extends Video {
    @Override
    void play() { 
        /* reprodução padrão com funcionalidades adicionais, por exemplo, qualidade HD */ 
    }
}
// Ambas as classes implementam o método sem quebrar o comportamento esperado.
```

---

## ✅ 4. Interface Segregation Principle (Princípio da Segregação de Interfaces)

**Explicação:**
Nenhuma classe deve ser obrigada a implementar métodos que não utiliza. Interfaces devem ser específicas para cada tipo de usuário ou funcionalidade, evitando implementar métodos desnecessários.

**Exemplo errado:**
```java
public interface UserActions {
    void watchVideo();
    void manageComments(); // Muitos usuários não precisarão moderar comentários
}
// Isso força usuários comuns a implementarem funcionalidades que não irão utilizar.
```

**Exemplo correto:**
```java
public interface ViewerActions {
    void watchVideo();
}

public interface ModeratorActions {
    void manageComments();
}

public class Viewer implements ViewerActions {
    public void watchVideo() {}
}

public class Moderator implements ViewerActions, ModeratorActions {
    public void watchVideo() {}
    public void manageComments() {}
}
// Cada classe implementa somente as interfaces com métodos relevantes à sua responsabilidade.
```

---

## ✅ 5. Dependency Inversion Principle (Princípio da Inversão de Dependências)

**Explicação:**
Dependa de abstrações, não de implementações concretas.

**Exemplo errado:**
```java
public class VideoService {
    private MySQLDatabase db = new MySQLDatabase();
}
```

**Exemplo correto:**
```java
public interface Database {
    void save(Object data);
}

public class MySQLDatabase implements Database {
    public void save(Object data) {}
}

public class VideoService {
    private Database database;

    public VideoService(Database database) {
        this.database = database;
    }
}
```

---



